<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "sciences".
 *
 * @property int $id
 * @property string|null $name
 *
 * @property TestsNames[] $testsNames
 */
class Sciences extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sciences';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 45],
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
        ];
    }

    /**
     * Gets query for [[TestsNames]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTestsNames()
    {
        return $this->hasMany(TestsNames::class, ['sciences_id' => 'id']);
    }

    public static function getList(){
        $model = self::find()->asArray()->all();
        $result = ArrayHelper::map($model, 'id', 'name');
        return $result;
    }
}
