<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "test_sing_up".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int $tests_names_id
 * @property string|null $create_date
 * @property string|null $start_date
 * @property string|null $end_date
 * @property string|null $questions
 *
 * @property MoneyOutput[] $moneyOutputs
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
            [['user_id', 'tests_names_id'], 'integer'],
            [['tests_names_id'], 'required'],
            [['create_date', 'start_date', 'end_date', 'questions'], 'safe'],
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
            'questions' => 'Questions',
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
     * Gets query for [[TestsNames]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTestsNames()
    {
        return $this->hasOne(TestsNames::class, ['id' => 'tests_names_id']);
    }
}
