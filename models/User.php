<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string|null $ism
 * @property string|null $familiya
 * @property string|null $sharif
 * @property string|null $login
 * @property string|null $parol
 * @property int|null $role
 * @property int $sinf_id
 *
 * @property Sinf $sinf
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role', 'sinf_id'], 'integer'],
            [['sinf_id'], 'required'],
            [['ism', 'familiya', 'sharif'], 'string', 'max' => 155],
            [['login', 'parol'], 'string', 'max' => 45],
            [['sinf_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sinf::class, 'targetAttribute' => ['sinf_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ism' => 'Ism',
            'familiya' => 'Familiya',
            'sharif' => 'Sharif',
            'login' => 'Login',
            'parol' => 'Parol',
            'role' => 'Role',
            'sinf_id' => 'Sinf ID',
        ];
    }

    /**
     * Gets query for [[Sinf]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSinf()
    {
        return $this->hasOne(Sinf::class, ['id' => 'sinf_id']);
    }
}
