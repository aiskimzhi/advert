<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $password
 * @property string $email
 * @property string $skype
 * @property string $phone
 * @property string $auth_key
 * @property string $password_reset_token
 * @property string $secret_key
 *
 * @property Advert[] $adverts
 * @property Bookmark[] $bookmarks
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'password', 'email', 'auth_key', 'password_reset_token'], 'required'],
            [['first_name', 'last_name', 'password', 'email', 'skype', 'phone', 'auth_key', 'password_reset_token'], 'string', 'max' => 255],
            ['secret_key', 'string', 'max' => 64],
            ['secret_key', 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'password' => 'Password',
            'email' => 'E-mail',
            'skype' => 'Skype',
            'phone' => 'Phone',
            'auth_key' => 'Auth Key',
            'password_reset_token' => 'Password Reset Token',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdverts()
    {
        return $this->hasMany(Advert::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookmarks()
    {
        return $this->hasMany(Bookmark::className(), ['user_id' => 'id']);
    }

    /**
     * from IdentityInterface
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($auth_key)
    {
        return $this->auth_key === $auth_key;
    }

    /**
     * It was taken from Advanced template common/models/User
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * this is a full name string for Logout label
     */
    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = 3600;
        return $timestamp + $expire >= time();
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
        ]);
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * Most of the methods bellow repeat the ones I've written before
     * but for password_reset_token
     */
    public function generateSecretKey()
    {
        $this->secret_key = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function removeSecretKey()
    {
        $this->secret_key = null;
    }

    public static function isSecretKeyExpire($key)
    {
        if(empty($key)) {
            return false;
        }

        $expire = Yii::$app->params['secretKeyExpire'];
        $parts = explode('_', $key);
        $timestamp = (int)end($parts);

        if ($timestamp + $expire >= time()) {
            return true;
        }

        return false;
    }

    public static function findBySecretKey($key)
    {
        if (!static::isSecretKeyExpire($key)) {
            return null;
        }

        return static::findOne(
            [
                'secret_key' => $key,
            ]
        );
    }
}
