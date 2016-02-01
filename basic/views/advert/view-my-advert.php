<?php

use yii\bootstrap\Carousel;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\widgets\DetailView;
use app\models\UploadForm;
use yii\bootstrap\Modal;
use yii\bootstrap\Tabs;
use app\models\Pictures;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Advert */
/* @var $imgModel app\models\UploadForm */

$this->title = $model->title;

echo '<div class="advert-view">';

echo '<div><h4>' . $model->category->name . ' » ' . $model->subcategory->name . '</h4></div>';

echo '<h2>' . $model->title . '</h2>';

echo '<h4>' . $model->region->name . ', ' . $model->city->name . '</h4>';

$format = 'd M Y, H:i';
echo 'Last update: ' . date($format, $model->updated_at);

//echo '<div>';
//$pics = $model->renderAllPics($model->id);
//foreach ($pics as $pic) {
//    $e = '<div>';
//    $e .= Html::beginForm('', 'post');
//    $e .= Html::img(Yii::$app->urlManager->createAbsoluteUrl('img/page_' . $model->id . '/' . $pic));
//    $e .= Html::submitButton('Delete picture', ['class' => 'btn btn-danger', 'name' => 'delete', 'value' => $pic]);
//    $e .= Html::endForm();
//    $e .= '</div>';
//    echo $e;
//}
//echo '</div>';

echo '<div>';
echo $model->text;
echo '</div>';



echo '</div>';

?>
<!--
<div id="for-table">
<table style="max-width: 650px;">
<tr id="header-line" style="height: 50px; max-height: 50px;">
    <td colspan="5" style="height: 50px; max-height: 50px; min-width: 400px;">
        <div style="position: relative; margin-left: 20px; margin-top: 20px; max-height: 40px;">
            <?php $form = ActiveForm::begin(['id' => 'add-picture', 'options' => ['enctype' => 'multipart/form-data']]); ?>
            <?= $form->field($imgModel, 'imageFile')->fileInput([
                'value' => 'choose',
                'style' => 'opacity: 0; z-index: 3; position: relative;',
            ])->label(false) ?>
            <div class="btn btn-success" style="position: relative; margin-top: -120px; margin-left: -12px; z-index: 1;">
                Choose a picture
            </div>
            <?= Html::submitButton('Add picture', [
                'class' => 'btn btn-success',
                'style' => 'position: relative; margin-top: -120px; margin-left: 100px;'
            ]) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </td>
</tr>
</table>
</div>
-->

<div id="file add" style="height: 50px; max-height: 50px; min-width: 400px;">
    <div style="position: relative; margin-left: 20px; margin-top: 20px; max-height: 40px;">
        <?php $form = ActiveForm::begin(['id' => 'add-picture', 'options' => ['enctype' => 'multipart/form-data']]); ?>
        <?= $form->field($imgModel, 'imageFile')->fileInput([
            'value' => 'choose',
            'style' => 'opacity: 0; z-index: 3; position: relative;',
        ])->label(false) ?>
        <div class="btn btn-success" style="position: relative; margin-top: -120px; margin-left: -12px; z-index: 1;">
            Choose a picture
        </div>
        <?= Html::submitButton('Add picture', [
            'class' => 'btn btn-success',
            'style' => 'position: relative; margin-top: -120px; margin-left: 100px;'
        ]) ?>

        <?php ActiveForm::end(); ?>
    </div>
</div>
<br><br>
<br><br>
<br><br>

<?php

echo '<p>';
echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
echo Html::a('Delete', ['delete', 'id' => $model->id], [
    'class' => 'btn btn-danger',
    'data' => [
        'confirm' => 'Are you sure you want to delete this advert?',
        'method' => 'post',
    ],
]);
echo '</p>';


echo '<br><br>';
echo FileInput::widget([
    'name' => 'attachment_48[]',
    'options'=>[
        'multiple'=>true
    ],
    'pluginOptions' => [
        'uploadUrl' => 'http://advert.dev/advert/file-upload?id=' . $_GET['id'],
        'maxFileCount' => 10
    ]
]);
