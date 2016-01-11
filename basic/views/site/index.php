<?php

/* @var $this yii\web\View */
use app\models\Pictures;
use yii\bootstrap\Carousel;
use yii\bootstrap\Modal;
use yii\helpers\Html;

$this->title = 'start again';
$id = 1;
$pic = new Pictures();

//$k = $pic->carouselItems(2, 1);
//echo '<pre>';
//var_dump($k);
//echo '</pre>';
?>

<div class="gallery" style="width: 70%; overflow: hidden; position: relative; display: block;">

<?php
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

<?php for ($i = 0; $i < count(scandir('img/page_' . $id)) - 2; $i++) : ?>
    <div class="border" style="<?= $border ?>">
        <img src="<?= $pic->imgList($id)[$i] ?>" style="max-width: 150px; max-height: 150px;">

        <div id="del">
            <?php $span = '<span class="glyphicon glyphicon-remove" style="color: #f3dc0f; background-color: #000000;"></span>'; ?>
            <?= Html::submitButton($span, ['style' => $del]) ?>
        </div>

        <div id="view">
            <?php Modal::begin([
                'header' => 'Picture',
                'toggleButton' => [
                    'label' => '<span class="glyphicon glyphicon-search" style="color: #f3dc0f; background-color: #000000;"></span>',
                    'style' => $view,
                ],
            ]);

            $items = $pic->carouselItems($i, $id);
            echo Carousel::widget([
                'items' => $items,
            ]);

            Modal::end(); ?>
        </div>
    </div>
<?php endfor; ?>

</div>