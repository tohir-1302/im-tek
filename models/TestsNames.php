<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tests_names".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $special_test_password
 * @property int $classes_id
 * @property int $user_id
 * @property int $sciences_id
 * @property int $status
 * @property int $sertificat_status
 * @property int $has_special_test
 * @property int $sertifikat_foiz
 * @property int|null $question_count
 * @property string|null $begin_date
 * @property string|null $status_date
 * @property string|null $time_limit
 *
 * @property Classes $classes
 * @property Questions[] $questions
 * @property Sciences $sciences
 */
class TestsNames extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tests_names';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['classes_id', 'sciences_id', 'question_count', 'begin_date', 'time_limit', 'name', 'end_date'], 'required'],
            [['classes_id', 'sciences_id', 'question_count', 'status', 'user_id', 'sertificat_status', 'sertifikat_foiz', 'has_special_test'], 'integer'],
            [['begin_date', 'time_limit', 'end_date', 'create_date', 'status_date'], 'safe'],
            [['name', 'special_test_password'], 'string', 'max' => 45],
            [['classes_id'], 'exist', 'skipOnError' => true, 'targetClass' => Classes::class, 'targetAttribute' => ['classes_id' => 'id']],
            [['sciences_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sciences::class, 'targetAttribute' => ['sciences_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Test nomi',
            'classes_id' => 'Sinfni tanlang',
            'sciences_id' => 'Fanni tanlang',
            'question_count' => 'Test savollar soni',
            'begin_date' => 'Boshlaninsh vaqti',
            'time_limit' => 'Davomiyligi (H/m/s)',
            'end_date' => 'Tugash vaqti',
            'has_special_test' => 'Maxsus test',
            'special_test_password' => 'Maxsus test paroli'
        ];
    }

    /**
     * Gets query for [[Classes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClasses()
    {
        return $this->hasOne(Classes::class, ['id' => 'classes_id']);
    }

    /**
     * Gets query for [[Questions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(Questions::class, ['tests_names_id' => 'id']);
    }

    /**
     * Gets query for [[Sciences]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSciences()
    {
        return $this->hasOne(Sciences::class, ['id' => 'sciences_id']);
    }

    public static function UpdateStatus($test_name_id){
        $model = self::findOne(['id'=>$test_name_id]);
        $questions_count = count(Questions::find()->where(['tests_names_id'=>$test_name_id])->asArray()->all());
        if ($model->question_count <= $questions_count) {
           $model->status = 2;
           $model->status_date = date("Y-m-d H:i:s");
           $model->save();
           return true;
        }else {
            return false;
        }
    }

    public static function validateDate($test_name_id){
        $model = self::findOne(['id'=>$test_name_id]);
        $date = date("Y-m-d H:i:s");
        if ($model->begin_date <= $date) {
           return true;
        }else {
            return false;
        }
    }

    public static function getAllTests(){
        $sql = '
            SELECT
            tn.id,
            CONCAT(c.name, "-sinf. ", s.name, " → " , tn.name) AS tests_name
        FROM tests_names tn
        LEFT JOIN classes c ON c.id = tn.classes_id
        LEFT JOIN sciences s ON s.id = tn.sciences_id
        WHERE tn.`status` = 2';

        $result = Yii::$app->getDb()->createCommand($sql)->queryAll();
        $result = ArrayHelper::map($result, 'id', 'tests_name');
        return $result;
    }


    public static function validateSpecilaTest($test_name_id, $password)
    {
        $test_name = self::findOne(['id' => $test_name_id]);
        if ($password === $test_name->special_test_password) {
            return true;
        }
        return false;
    }
}
