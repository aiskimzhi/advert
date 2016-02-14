<?php

/* @var $model app\models\ContactAuthor */
/* @var $receiver app\models\Advert */

use yii\helpers\Html;

echo 'Hello ' . Html::encode($receiver->user->first_name) . ' ' . Html::encode($receiver->user->last_name) . '!<br>';

echo $model->text;
