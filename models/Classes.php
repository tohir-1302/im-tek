<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "classes".
 *
 * @property int $id
 * @property string|null $name
 *
 * @property Sciences[] $sciences
 */
class Classes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'classes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
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
     * Gets query for [[Sciences]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSciences()
    {
        return $this->hasMany(Sciences::class, ['sinf_id' => 'id']);
    }

    public static function getList(){
        $model = self::find()->asArray()->all();
        $result = ArrayHelper::map($model, 'id', 'name');
        return $result;
    }
}
