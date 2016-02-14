<?php

/* @var $user \app\models\User */

use yii\helpers\Html;

echo 'Hello ' . Html::encode($user->first_name) . ' ' . Html::encode($user->last_name) . '!';

echo Html::a('Follow the link to change your password',
    Yii::$app->urlManager->createAbsoluteUrl(
        [
            'site/reset-password',
            'key' => $user->secret_key,
        ]
    )
);
