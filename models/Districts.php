<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "districts".
 *
 * @property int $id
 * @property string|null $name
 * @property int $regions_id
 *
 * @property Regions $regions
 * @property Schools[] $schools
 */
class Districts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'districts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['regions_id','name'], 'required'],
            [['regions_id'], 'integer'],
            [['name'], 'string', 'max' => 145],
            [['regions_id'], 'exist', 'skipOnError' => true, 'targetClass' => Regions::class, 'targetAttribute' => ['regions_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tuman nomi',
            'regions_id' => 'Viloyat',
        ];
    }

    /**
     * Gets query for [[Regions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegions()
    {
        return $this->hasOne(Regions::class, ['id' => 'regions_id']);
    }

    /**
     * Gets query for [[Schools]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSchools()
    {
        return $this->hasMany(Schools::class, ['districts_id' => 'id']);
    }

    public static function getList(){
        $model = self::find()->asArray()->all();
        $result = ArrayHelper::map($model, 'id', 'name');
        return $result;
    }

 
}
