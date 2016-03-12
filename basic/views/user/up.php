<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\bootstrap\ActiveField;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Update data';
?>

<h2 id="h2-update"><strong><em>Enter new data: </em></strong></h2>


<?php $form = ActiveForm::begin([
    'id' => 'login-form',
//    'options' => ['class' => 'form-inline'],
//    'fieldConfig' => [
//        'labelOptions' => ['style' => 'width: 80px; text-align: right; margin-right: 20px;'],
//        'inputOptions' => ['class' => 'form-control', 'style' => 'width: 500px;'],
//        'errorOptions' => ['style' => 'margin-left: 105px;', 'class' => 'help-block']
//    ],
]); ?>


    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'skype')->textInput(['maxlength' => true]) ?>
<?= Html::submitButton('Update', [
    'class' => 'btn but btn-primary', 'id' => 'but-sub',
//    'style' => 'width: 500px; margin-left: 104px;'
]) ?>




<?php ActiveForm::end(); ?>
