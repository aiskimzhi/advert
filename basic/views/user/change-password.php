<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ChangePassword */
/* @var $form ActiveForm */

$this->title = 'Password Change'
?>

<div class="user-change-password">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'oldPassword')->passwordInput() ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'confirmPassword')->passwordInput() ?>
    
        <div class="form-group">
            <?= Html::submitButton('Change password', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div>
