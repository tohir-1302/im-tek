<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\validators\SafeValidator;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $verification_token
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property string $father_is_name
 * @property string $auth_key
 * @property string $birthday
 * @property string $schools
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $role
 * @property integer $districts_id
 * @property integer $regions_id
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    const Admin = 1;
    const Teacher = 2;
    const Client = 3;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        // return [
        //     [['role', 'regions_id', 'districts_id'], 'integer'],
        //     [['birthday'], 'safe'],
        //     [['first_name', 'last_name', 'father_is_name', 'schools'], 'string'],
        //     ['status', 'default', 'value' => self::STATUS_INACTIVE],
        //     ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
        // ];
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Bu foydalanuvchi nomi orqali ro`yxatdan o`tilgan'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            [['last_name', 'father_is_name', 'first_name', 'schools'], 'string', 'max' => 150],
            [['last_name', 'father_is_name', 'first_name', 'birthday', 'schools', 'regions_id', 'districts_id'], 'required'],
            [['regions_id', 'districts_id'], 'integer'],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['birthday', 'safe'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Bu E-pochta orqali ro`yxatdan o`tilgan'],

            ['password_hash', 'required'],
            ['password_hash', 'string', 'min' => 8],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
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
            'schools' => 'Maktab nomi',
            'regions_id' => 'Hudud',
            'districts_id' => 'Tuman(shahar)'

        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token) {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        // return Yii::$app->security->validatePassword($password, $this->password_hash);
        return $password === $this->password_hash;

    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = $password;
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Generates new token for email verification
     */
    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
}
