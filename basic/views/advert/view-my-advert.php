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
?>
<div class="advert-view">

    <div><h4> <?= $model->category->name ?>  »  <?= $model->subcategory->name ?> </h4></div>

    <h2> <?= $model->title ?> </h2>

    <h4> <?= $model->region->name ?> ,  <?= $model->city->name ?> </h4>

    <p>Last update:  <?= date(Yii::$app->params['dateFormat'], $model->updated_at) ?></p>

    <div><?= $model->text ?></div>

</div>


<?php
//var_dump($pic->imgList($model->id)[0]); die;
$form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data'],
]);
echo $form->field($imgModel, 'imageFiles[]')->widget(FileInput::classname(), [
    'options' => ['multiple' => true],
    'pluginOptions' => ['previewFileType' => 'any']
])->label('Add images');
ActiveForm::end();

$border = 'float: left;
        border: solid;
        border-width: 1px;
        border-color: #808080;
        width: 154px; max-width: 154px; min-width: 154px;
        height: 190px; max-height: 190px; min-height: 190px;
        position: relative;
        margin-right: 5px;
        margin-bottom: 5px;';
$del = 'position: absolute;
        bottom: 0;
        right: 0;
        border: solid;
        height: 30px;
        width: 30px;
        background-color: #000000;
        border-color: #f3dc0f;';
$view = 'position: absolute;
        bottom: 0;
        right: 30px;
        border: solid;
        height: 30px;
        width: 30px;
        background-color: #000000;
        border-color: #f3dc0f;
        margin-right: 5px;';

?>

<div style="max-width: 800px">
<?php for ($i = 0; $i < count(scandir('img/page_' . $model->id)) - 2; $i++) : ?>
    <div class="border" style="<?= $border ?>">
        <img src="<?= $pic->imgList($model->id)[$i] ?>" style="max-width: 150px; max-height: 150px;">

        <div id="del">
            <?php $span = '<span class="glyphicon glyphicon-remove" style="color: #f3dc0f; background-color: #000000;"></span>'; ?>
            <form action="" method="post">
                <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>">
                <?= Html::submitButton($span, ['name' => 'delete',
                    'value' => array_splice(scandir('img/page_' . $model->id), 2)[$i],
                    'style' => $del
                ]) ?>
                <!-- <input type="submit" name="delete" value=""> -->
            </form>


        </div>

        <div id="view">
            <?php Modal::begin([
                'size' => 'modal-lg',
                'toggleButton' => [
                    'label' => '<span class="glyphicon glyphicon-search" style="color: #f3dc0f; background-color: #000000;"></span>',
                    'style' => $view,
                ],
//                'options' => ['style' => 'width: 500px;']
            ]);

            $items = $pic->carouselItems($i, $model->id);
            echo Carousel::widget([
                'items' => $items,
                'options' => [
                    'style' => 'width: 80%; height: 400px; margin: 0 auto;',
                ],
            ]);

            Modal::end(); ?>
        </div>
    </div>
<?php endfor; ?>
</div>

<div style="clear: both">
    <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Delete', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Are you sure you want to delete this advert?',
            'method' => 'post',
        ],
    ]) ?>
</div>
