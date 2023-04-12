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

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['regions_id', 'districts_id'], 'integer'],
            ['schools', 'string', 'max' => 255],
        ];
    }


    public function attributeLabels()
    {
        return [
            'districts_id' => 'Tuman(shahar)',
            'regions_id' => 'Hudud',
            'schools' => 'Maktab',
            
        ];
    }
}