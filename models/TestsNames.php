<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tests_names".
 *
 * @property int $id
 * @property string|null $name
 * @property int $classes_id
 * @property int $sciences_id
 * @property int|null $question_count
 * @property string|null $begin_date
 * @property string|null $time_limit
 *
 * @property Classes $classes
 * @property Questions[] $questions
 * @property Sciences $sciences
 */
class TestsNames extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tests_names';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['classes_id', 'sciences_id', 'question_count', 'begin_date', 'time_limit', 'name', 'end_date'], 'required'],
            [['classes_id', 'sciences_id', 'question_count'], 'integer'],
            [['begin_date', 'time_limit', 'end_date'], 'safe'],
            [['name'], 'string', 'max' => 45],
            [['classes_id'], 'exist', 'skipOnError' => true, 'targetClass' => Classes::class, 'targetAttribute' => ['classes_id' => 'id']],
            [['sciences_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sciences::class, 'targetAttribute' => ['sciences_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Test nomi',
            'classes_id' => 'Sinfni tanlang',
            'sciences_id' => 'Fanni tanlang',
            'question_count' => 'Test savollar soni',
            'begin_date' => 'Boshlaninsh vaqti',
            'time_limit' => 'Davomiyligi (H/m/s)',
            'end_date' => 'Tugash vaqti'
        ];
    }

    /**
     * Gets query for [[Classes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClasses()
    {
        return $this->hasOne(Classes::class, ['id' => 'classes_id']);
    }

    /**
     * Gets query for [[Questions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(Questions::class, ['tests_names_id' => 'id']);
    }

    /**
     * Gets query for [[Sciences]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSciences()
    {
        return $this->hasOne(Sciences::class, ['id' => 'sciences_id']);
    }
}
