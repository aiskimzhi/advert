<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 08.02.2016
 * Time: 20:28
 */

namespace app\models;


use Yii;
use yii\db\ActiveRecord;

class ContactAuthor extends ActiveRecord
{
    public $text;
    public $subject;

    public function rules()
    {
        return [
            [['text', 'subject'], 'required'],
            ['subject', 'string', 'max' => 64],
            ['text', 'string']
        ];
    }

    public function sendEmail($sender_email, $receiver_email, $subject, $receiver, $model)
    {
        return Yii::$app->mailer->compose('contactAuthor', [
            'receiver' => $receiver,
            'model' => $model
        ])
            ->setFrom($sender_email)
            ->setTo($receiver_email)
            ->setSubject($subject)
            ->send();
    }
} 
