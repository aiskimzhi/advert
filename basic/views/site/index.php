<?php

/* @var $this yii\web\View */
use app\models\Pictures;
use app\models\UploadForm;
use yii\bootstrap\Carousel;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\file\FileInput;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;


$this->title = 'start again';
$id = 1;
$pic = new Pictures();

echo '<pre>';
$k = scandir('img/page_1');
$m = array_splice($k, 2);
print_r($m);
echo '</pre>';
die;

var_dump(Yii::$app->params);
echo '<br><br>';
echo Yii::$app->params['maxPics'] . '<br><br>';
$ext = 'kjhjka.png';
$pos = strrpos($ext, '.');
$t = substr($ext, $pos);
var_dump($t);
echo '<br><br>';
var_dump(pathinfo($ext)['extension']);

//$k = $pic->carouselItems(2, 1);
//echo '<pre>';
//var_dump($k);
//echo '</pre>';
echo '<br><br>';

?>
<br><br>
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

<?php for ($i = 0; $i < 5; $i++) : ?>
    <div class="border" style="<?= $border ?>">
        <img src="<?= $pic->imgList($id)[$i] ?>" style="max-width: 150px; max-height: 150px;">

        <div id="del">
            <?php $span = '<span class="glyphicon glyphicon-remove" style="color: #f3dc0f; background-color: #000000;"></span>'; ?>
            <?= Html::submitButton($span, ['style' => $del]) ?>
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

            $items = $pic->carouselItems($i, $id);
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

    <?php
//    $items = $pic->carouselItems(0, $id);
//    echo Carousel::widget([
//        'items' => [
//            [
//                'content' => '<img src="/img/page_1/serd209.png" style="max-width: 300px; max-height: 200px; margin: 0 auto;">',
//            ],
//            [
//                'content' => '<img src="/img/page_1/img_01.png" style="max-width: 300px; max-height: 200px; margin: 0 auto;">',
//            ]
//        ],
//        'options' => [
//            'style' => 'width: 300px; height: 200px;',
//        ],
//    ]);


    ?>
</div>

<form action="" method="post">
    <?= Html::submitButton($span, ['name' => 'name', 'value' => 'value', 'style' => $del]) ?>
    <!-- <input type="submit" name="delete" value=""> -->
</form>
