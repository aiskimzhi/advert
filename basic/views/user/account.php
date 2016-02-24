<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'My Account';
?>

<div class="account">

    <div id="left-menu">
        <?= Html::a('My Adverts',
            [Url::toRoute(['advert/my-adverts'])],
            ['class' => 'btn btn-info my-200']) ?>
        <?= Html::a('My Bookmarks',
            [Url::toRoute(['bookmark/my-bookmarks'])],
            ['class' => 'btn btn-info my-200'])?>
        <?= Html::a('Update data',
            [Url::toRoute('update-data')],
            ['class' => 'btn btn-info my-200']) ?>
        <?= Html::a('Change password',
            [Url::toRoute('change-password')],
            ['class' => 'btn btn-info my-200'])?>
        <?= Html::a('Delete account', ['delete-account'], [
            'class' => 'btn btn-info my-200 my-del',
            'data' => [
                'confirm' => 'Are you sure you want to delete your account?',
                'method' => 'post',
            ],
        ]) ?>
    </div>

    <div id="personal-info">
        <h1><?= $model->getFullName()?></h1>
        <p><em>My contacts: </em></p>
        <p><strong>E-mail: </strong><?= $model->email ?></p>
        <p><strong>Phone: </strong><?= $model->phone ?></p>
        <p><strong>Skype: </strong><?= $model->skype ?></p>
    </div>

    <div id="create-adv">
        <?= Html::a('Create Advert', [Url::toRoute(['advert/create'])],
            ['class' => 'btn btn-primary btn-cr-adv']) ?>
    </div>

</div>
