<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\bootstrap\ActiveField;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Update data';
?>

<h2 id="h2-update"><strong><em>Enter new data: </em></strong></h2>
<div id="update-form">
    <?php $form = ActiveForm::begin(); ?>
    <div id="left-labels">
        <div class="labels-p"><strong>First name: </strong></div>
        <div class="labels-p"><strong>Last name: </strong></div>
        <div class="labels-p"><strong>E-mail: </strong></div>
        <div class="labels-p"><strong>Phone: </strong></div>
        <div class="labels-p"><strong>Skype: </strong></div>
        <div class="labels-p"></div>
    </div>

    <div id="update-inputs">
        <?= $form->field($model, 'first_name')->textInput(['maxlength' => true])->label(false) ?>
        <?= $form->field($model, 'last_name')->textInput(['maxlength' => true])->label(false) ?>
        <?= $form->field($model, 'email')->textInput(['maxlength' => true])->label(false) ?>
        <?= $form->field($model, 'phone')->textInput(['maxlength' => true])->label(false) ?>
        <?= $form->field($model, 'skype')->textInput(['maxlength' => true])->label(false) ?>
        <?= Html::submitButton('Update', ['class' => 'btn but btn-create', 'id' => 'but-sub']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
