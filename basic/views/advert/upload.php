<?php

use app\models\Advert;
use kartik\file\FileInput;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\User;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UploadForm */
/* @var $user app\models\User */
/* @var $adv app\models\Advert */

$adv = new Advert();
$form = ActiveForm::begin([
//    'action' => Url::toRoute(['my-adverts']),
    'options' => ['enctype' => 'multipart/form-data'],
]);

echo $form->field($model, 'imageFiles[]')->widget(FileInput::classname(), [
    'options' => ['multiple' => true],
    'pluginOptions' => ['previewFileType' => 'any']
]);

//echo $form->field($adv, 'title')->textInput();
echo Html::a('Skip this step', [Url::toRoute(['my-adverts'])], ['class' => 'btn btn-success']);
//echo '<div class="form-group">' . Html::submitButton('Create Advert', ['class' => 'btn btn-success']) . '</div>';

ActiveForm::end();

