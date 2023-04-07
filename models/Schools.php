<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "schools".
 *
 * @property int $id
 * @property string|null $name
 * @property int $districts_id
 *
 * @property Districts $districts
 */
class Schools extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'schools';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'districts_id'], 'required'],
            [['id', 'districts_id'], 'integer'],
            [['name'], 'string', 'max' => 145],
            [['id'], 'unique'],
            [['districts_id'], 'exist', 'skipOnError' => true, 'targetClass' => Districts::class, 'targetAttribute' => ['districts_id' => 'id']],
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
            'districts_id' => 'Districts ID',
        ];
    }

    /**
     * Gets query for [[Districts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDistricts()
    {
        return $this->hasOne(Districts::class, ['id' => 'districts_id']);
    }
}
