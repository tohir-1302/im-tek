<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tests".
 *
 * @property string|null $savol
 * @property string|null $A
 * @property string|null $testcol
 * @property int $tests_names_id
 *
 * @property TestsNames $testsNames
 */
class Tests extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tests';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tests_names_id'], 'required'],
            [['tests_names_id'], 'integer'],
            [['savol', 'A'], 'string', 'max' => 455],
            [['testcol'], 'string', 'max' => 45],
            [['tests_names_id'], 'exist', 'skipOnError' => true, 'targetClass' => TestsNames::class, 'targetAttribute' => ['tests_names_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'savol' => 'Savol',
            'A' => 'A',
            'testcol' => 'Testcol',
            'tests_names_id' => 'Tests Names ID',
        ];
    }

    /**
     * Gets query for [[TestsNames]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTestsNames()
    {
        return $this->hasOne(TestsNames::class, ['id' => 'tests_names_id']);
    }
}
