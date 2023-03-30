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
 * @property string|null $file
 * @property int|null $answer_option 1→A_option; 2→B_option; 3→C_option; 4→D_option
 * @property string|null $question
 *
 * @property TestsNames $testsNames
 */
class Questions extends \yii\db\ActiveRecord
{

    public $file;
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
            [['tests_names_id', 'question', 'answer_option', 'option_A', 'option_B', 'option_C', 'option_D'], 'required'],
            [['tests_names_id', 'answer_option'], 'integer'],
            [['option_A', 'option_B', 'option_C', 'option_D', 'question', 'file_name'], 'string'],
            [['file'], 'file', 'extensions' => 'png, jpg, jpeg, gif', 'maxFiles' => 3, 'maxSize' => 50 * 1024 * 1024],
            [['tests_names_id'], 'exist', 'skipOnError' => true, 'targetClass' => TestsNames::class, 'targetAttribute' => ['tests_names_id' => 'id']]
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
            'option_A' => 'Variant A',
            'option_B' => 'Variant B',
            'option_C' => 'Variant C',
            'option_D' => 'Variant D',
            'answer_option' => 'To`g`ri Variant',
            'question' => 'Savol',
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

    public static function getAnswerQuestion(){
        $result =[
            1 => 'A',
            2 => 'B',
            3 => 'C',
            4 => 'D',
        ];

        return $result;
    }
}
