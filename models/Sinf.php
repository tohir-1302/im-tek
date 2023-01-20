<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sinf".
 *
 * @property int $id
 * @property string|null $name
 *
 * @property Fan[] $fans
 * @property User[] $users
 */
class Sinf extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sinf';
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
     * Gets query for [[Fans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFans()
    {
        return $this->hasMany(Fan::class, ['sinf_id' => 'id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['sinf_id' => 'id']);
    }
}
