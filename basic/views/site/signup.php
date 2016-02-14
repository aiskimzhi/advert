<?php

/* @var $this yii\web\View */
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;

/* @var $model app\models\SignupForm */
/* @var $form ActiveForm */

$this->title = 'Sign Up';
?>
<div class="site-signup">

    <div style="width: 40%; float: left; margin-left: 5%;">
        <h3><strong>Create account</strong></h3>
        <?php $form = ActiveForm::begin([
            'fieldConfig' => [
                'template' => "{input}\n{error}",
                'horizontalCssClasses' => [
                    'error' => '',
                ],
            ],
        ]); ?>

        <?= $form->field($model, 'first_name')->textInput(['placeholder' => 'Enter your first name'])->label(false) ?>
        <?= $form->field($model, 'last_name')->textInput(['placeholder' => 'Enter your last name'])->label(false) ?>
        <?= $form->field($model, 'email')->textInput(['placeholder' => 'Enter your e-mail'])->label(false) ?>
        <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Enter password'])->label(false) ?>
        <?= $form->field($model, 'repeated_password')->passwordInput(['placeholder' => 'Repeat your password'])->label(false) ?>
        <?= $form->field($model, 'skype')->textInput(['placeholder' => 'Enter your skype'])->label(false) ?>
        <?= $form->field($model, 'phone')->textInput(['placeholder' => 'Enter your phone number'])->label(false) ?>

        <?= Html::submitButton('<strong>Sign Up</strong>', ['class' => 'btn btn-primary but btn-create']) ?>

        <?php ActiveForm::end(); ?>
    </div>

    <div style="width: 40%; float: left; margin-left: 10%;">
        <br><br><br>
        After you sign up you will be able to: <br><br>
        <table>
            <tr>
                <td><span class="glyphicon glyphicon-ok"></span> </td>
                <td width="20px"></td>
                <td> place your adverts,</td>
            </tr>
            <tr>
                <td><span class="glyphicon glyphicon-ok"></span> </td>
                <td width="20px"></td>
                <td> update and delete your adverts,</td>
            </tr>
            <tr>
                <td><span class="glyphicon glyphicon-ok"></span> </td>
                <td width="20px"></td>
                <td> search for other user's adverts and look through them,</td>
            </tr>
            <tr>
                <td><span class="glyphicon glyphicon-ok"></span> </td>
                <td width="20px"></td>
                <td> contact another user if necessary,</td>
            </tr>
            <tr>
                <td><span class="glyphicon glyphicon-ok"></span> </td>
                <td width="20px"></td>
                <td> other users will be able to contact you if they are interested in your advert</td>
            </tr>
        </table>
    </div>

</div>

