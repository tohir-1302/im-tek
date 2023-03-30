<?php

namespace app\models;

use DateTimeImmutable;
use Yii;

/**
 * This is the model class for table "test_answer".
 *
 * @property int $id
 * @property int $test_sing_up_id
 * @property int $questions_id
 * @property int $number
 * @property int|null $answer_success
 * @property int|null $answer_client
 *
 * @property Questions $questions
 * @property TestSingUp $testSingUp
 */
class TestAnswer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'test_answer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['test_sing_up_id', 'questions_id'], 'required'],
            [['test_sing_up_id', 'questions_id', 'answer_success', 'answer_client', 'number'], 'integer'],
            [['questions_id'], 'exist', 'skipOnError' => true, 'targetClass' => Questions::class, 'targetAttribute' => ['questions_id' => 'id']],
            [['test_sing_up_id'], 'exist', 'skipOnError' => true, 'targetClass' => TestSingUp::class, 'targetAttribute' => ['test_sing_up_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'test_sing_up_id' => 'Test Sing Up ID',
            'questions_id' => 'Questions ID',
            'answer_success' => 'Answer Success',
            'answer_client' => 'Answer Client',
        ];
    }

    /**
     * Gets query for [[Questions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasOne(Questions::class, ['id' => 'questions_id']);
    }

    /**
     * Gets query for [[TestSingUp]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTestSingUp()
    {
        return $this->hasOne(TestSingUp::class, ['id' => 'test_sing_up_id']);
    }

    public static function getAllQuestions($test_sing_up_id){
        $sql = '
                    SELECT 
            test_answer.*,
            questions.question,
            questions.option_A,
            questions.option_B,
            questions.option_C,
            questions.option_D,
            questions.file_name
            FROM test_answer
            #LEFT JOIN test_sing_up ON test_sing_up.id = test_answer.test_sing_up_id
            LEFT JOIN questions ON questions.id = test_answer.questions_id
            WHERE test_answer.test_sing_up_id = :test_sing_up_id 
            order by test_answer.number  ASC';

        $result = Yii::$app->getDb()->createCommand($sql, [':test_sing_up_id' => $test_sing_up_id])->queryAll();

        return $result;
    }

    public static function getOneQuestions($questions_number, $tets_names_id){
        $tets_names = TestsNames::findOne(['id'=>$tets_names_id]);
        $test_sing_up = TestSingUp::getSingUpId($tets_names_id, $tets_names->time_limit);
        $allQuestions = TestAnswer::getAllQuestions($test_sing_up->id);
       
        $result = [
            'test_name' => $tets_names->name,
            'tets_names_id' => $tets_names->id,
            'time' => 0,
            'question' => 0,
            'test_count' => [],
        ];

        foreach ($allQuestions as $item) {
            if ($item['number'] == $questions_number) {
                $result['question'] = $item;
            }
            $result['test_count'][$item['number']] = $item['answer_client'];
        }
            $result['time'] = $test_sing_up->end_date;

        return $result; 
    }
}
