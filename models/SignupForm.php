<?php

namespace app\models;

use app\models\User;
use Yii;
use yii\base\Model;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $last_name;
    public $father_is_name;
    public $first_name;
    public $birthday;
    public $districts_id;
    public $regions_id;
    public $schools;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Bu foydalanuvchi nomi orqali ro`yxatdan o`tilgan'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            [['last_name', 'father_is_name', 'first_name', 'schools'], 'string', 'max' => 150],
            [['last_name', 'father_is_name', 'first_name', 'birthday', 'schools', 'regions_id', 'districts_id'], 'required'],
            [['regions_id', 'districts_id'], 'integer'],
            ['email', 'trim'],
            // ['email', 'required'],
            // ['email', 'email'],
            ['birthday', 'safe'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Bu E-pochta orqali ro`yxatdan o`tilgan'],

            ['password', 'required'],
            ['password', 'string', 'min' => 8],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'Ism',
            'last_name' => 'Familiya',
            'father_is_name' => 'Sharifi',
            'username' => 'Foydalanuvchi nomi',
            'email' => 'E-pochta',
            'password' => 'Parol',
            'birthday' => 'Tug\'ilgan kun',
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->status = 10;
        $user->first_name = $this->first_name;
        $user->father_is_name = $this->father_is_name;
        $user->last_name = $this->last_name;
        $user->birthday = $this->birthday;
        $user->schools = $this->schools;
        $user->regions_id = $this->regions_id;
        $user->districts_id = $this->districts_id;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();

        return $user->save(false);
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}