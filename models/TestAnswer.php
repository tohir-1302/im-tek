<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "test_answer".
 *
 * @property int $id
 * @property int $test_sing_up_id
 * @property int $questions_id
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
            [['test_sing_up_id', 'questions_id', 'answer_success', 'answer_client'], 'integer'],
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
}
