<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tests_names".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $test_namecol
 * @property int $classes_id
 * @property int $sciences_id
 *
 * @property Classes $classes
 * @property Sciences $sciences
 * @property Tests[] $tests
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
            [['classes_id', 'sciences_id'], 'required'],
            [['classes_id', 'sciences_id'], 'integer'],
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
            'name' => 'Name',
            'classes_id' => 'Classes ID',
            'sciences_id' => 'Sciences ID',
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
     * Gets query for [[Sciences]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSciences()
    {
        return $this->hasOne(Sciences::class, ['id' => 'sciences_id']);
    }

    /**
     * Gets query for [[Tests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTests()
    {
        return $this->hasMany(Tests::class, ['tests_names_id' => 'id']);
    }
}
