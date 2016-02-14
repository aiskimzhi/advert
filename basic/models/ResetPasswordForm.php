<?php

namespace app\models;

use Yii;
use yii\base\Model;

class ResetPasswordForm extends Model
{
    public $password;
//    private $_user;

    public function rules()
    {
        return [
            ['password', 'required']
        ];
    }

    public function resetPassword()
    {
        /* @var $user User */
        $user = User::findOne(['secret_key' => $_GET['key']]);

        $user->setPassword($this->password);
        $user->removeSecretKey();
        return $user->save();
    }
}
