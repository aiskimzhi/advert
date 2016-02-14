<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
?>
<div class="site-login">

<h2><strong>Login</strong></h2><br>
    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'email')->textInput(['placeholder' => 'E-mail'])->label(false) ?>
        <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password'])->label(false) ?>
        <?= $form->field($model, 'rememberMe')->checkbox([
//            'template' => "<div>{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ]) ?>

        <div class="form-group">
                <?= Html::submitButton('<strong>Login</strong>', [
                    'class' => 'btn btn-primary but btn-create', 'name' => 'login-button'
                ]) ?>
        </div>

    <?php ActiveForm::end(); ?>

    <?= Html::a('Forgot password?', ['site/send-email']) ?>
</div>
