<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "test_sing_up".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int $tests_names_id
 * @property string|null $create_date
 * @property string|null $start_date
 * @property string|null $end_date
 *
 * @property MoneyOutput[] $moneyOutputs
 * @property TestAnswer[] $testAnswers
 * @property TestsNames $testsNames
 */
class TestSingUp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'test_sing_up';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'tests_names_id', 'tests_status'], 'integer'],
            [['tests_names_id'], 'required'],
            [['create_date', 'start_date', 'end_date'], 'safe'],
            [['tests_names_id'], 'exist', 'skipOnError' => true, 'targetClass' => TestsNames::class, 'targetAttribute' => ['tests_names_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'tests_names_id' => 'Tests Names ID',
            'create_date' => 'Create Date',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
        ];
    }

    /**
     * Gets query for [[MoneyOutputs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMoneyOutputs()
    {
        return $this->hasMany(MoneyOutput::class, ['test_sing_up_id' => 'id']);
    }

    /**
     * Gets query for [[TestAnswers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTestAnswers()
    {
        return $this->hasMany(TestAnswer::class, ['test_sing_up_id' => 'id']);
    }

    /**
     * Gets query for [[TestsNames]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTestsNames()
    {
        return $this->hasOne(TestsNames::class, ['id' => 'tests_names_id']);
    }
    public static function addSingUp($tests_names_id){
        $tests_names = TestsNames::find()->where(['id' => $tests_names_id])->asArray()->one();
        $questions = Questions::find()->where(['tests_names_id' => $tests_names_id])->asArray()->orderBy(['id'=>SORT_DESC])->all();
        $questions = ArrayHelper::map($questions, 'id', 'answer_option');

        $new_test_sing_up = new TestSingUp();
        $new_test_sing_up->create_date = date("Y-m-d H:i:s");
        $new_test_sing_up->user_id = 33;
        $new_test_sing_up->tests_names_id = $tests_names_id;
        $new_test_sing_up->tests_status = 1;
        if($new_test_sing_up->save()){
            $question_date = [];
            $count = 0;
            while ($count < $tests_names['question_count']) {
                $question_id = rand(1, array_key_first($questions));
                if (!isset($question_date[$question_id]) && isset($questions[$question_id])) {
                    $question_date[$question_id] = [
                        "question_id" => $question_id,
                        "answer_client" => 0,
                        "answer_success" =>  $questions[$question_id]
                        ];
                    
                    $model = new TestAnswer();
                    $model->test_sing_up_id = $new_test_sing_up->id;
                    $model->questions_id = $question_id;
                    $model->answer_success = $questions[$question_id];
                    $model->answer_client = 0;
                    if($model->save()){
                        $count++;
                    }else{
                        return false;
                    }
                }
            }
        }else{
            return false;
        }

        return true;
    }

        

}
