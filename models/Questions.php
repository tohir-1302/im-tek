<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "questions".
 *
 * @property int $id
 * @property int $tests_names_id
 * @property string|null $option_A
 * @property string|null $option_B
 * @property string|null $option_C
 * @property string|null $option_D
 * @property int|null $answer_option 1→A_option; 2→B_option; 3→C_option; 4→D_option
 *
 * @property TestsNames $testsNames
 */
class Questions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'questions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tests_names_id'], 'required'],
            [['tests_names_id', 'answer_option'], 'integer'],
            [['option_A', 'option_B', 'option_C', 'option_D'], 'string'],
            [['tests_names_id'], 'exist', 'skipOnError' => true, 'targetClass' => TestsNames::class, 'targetAttribute' => ['tests_names_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tests_names_id' => 'Tests Names ID',
            'option_A' => 'Option A',
            'option_B' => 'Option B',
            'option_C' => 'Option C',
            'option_D' => 'Option D',
            'answer_option' => 'Answer Option',
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
