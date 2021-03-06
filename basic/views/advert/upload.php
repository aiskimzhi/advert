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
    'options' => ['enctype' => 'multipart/form-data'],
]);

echo $form->field($model, 'imageFiles[]')->widget(FileInput::classname(), [
    'options' => ['multiple' => true],
    'pluginOptions' => ['previewFileType' => 'any']
]);

echo Html::a('Skip this step', [Url::toRoute(['my-adverts'])], ['class' => 'btn btn-primary']);

ActiveForm::end();
