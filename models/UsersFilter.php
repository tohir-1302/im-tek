<?php

namespace app\models;

use yii\base\Model;

/**
 * Signup form
 */
class UsersFilter extends Model
{
    public $regions_id;
    public $districts_id;
    public $schools;
    public $tests_names_id;
    public $fio;
    public $role;
    public $password;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['regions_id', 'districts_id', 'role'], 'integer'],
            [['fio','schools', 'password'], 'string', 'max' => 255],
        ];
    }


    public function attributeLabels()
    {
        return [
            'districts_id' => 'Tuman(shahar)',
            'regions_id' => 'Hudud',
            'schools' => 'Maktab',
            'fio' => 'Ism, Familiya',
        ];
    }

    public static function getRole(){
        return [
            1 => 'Admin',
            2 => 'Teacher',
            3 => 'Client',
        ];
    }

    public static function getStatus(){
        return [
            10 => 'Active',
            9 => 'Passive',
        ];
    }
}