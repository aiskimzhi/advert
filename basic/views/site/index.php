<?php

/* @var $this yii\web\View */
use app\models\Bookmark;
use app\models\Pictures;
use app\models\UploadForm;
use app\models\User;
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

//$h[] = '<img src="/img/page_3/1.jpg">';
//$h[] = '<img src="/img/page_3/2.jpg">';
//$h[] = '<img src="/img/page_3/3.png">';
//$h[] = '<img src="/img/page_3/4.png">';
//echo Carousel::widget([
//    'items' => $h,
//]);

$items = [
    [
        'content' => '<img src="/img/page_3/1.jpg" id="pic1">',
        'caption' => '<h4>Picture 1</h4><p>This is the caption text</p>',
    ],
    [
        'content' => '<img src="/img/page_3/2.jpg">',
        'caption' => '<h4>Picture 2</h4><p>This is the caption text</p>',
    ],
    [
        'content' => '<img src="/img/page_3/3.png">',
        'caption' => '<h4>Picture 3</h4><p>This is the caption text</p>',
    ],
    [
        'content' => '<img src="/img/page_3/4.png">',
        'caption' => '<h4>Picture 4</h4><p>This is the caption text</p>',
    ]
];
echo Carousel::widget([
    'items' => $items,
    'options' => [
        'style' => 'width: 80%; height: 400px; margin: 0 auto;',
        'data-interval' => 'false',
    ],
]);
?>


<button onclick="alert(avatar())">HI</button>
<form>
    <input type="submit" name="name" value="HOHO" id="avatar">
</form>

<?php

//$bookmark = Bookmark::find()->where([
//    'user_id' => Yii::$app->user->identity->getId(),
//    'advert_id' => 11
//])->one();

$k = array_splice(scandir('img/page_3'), 2);
$max = count(scandir('img/page_3')) - 2;
$n = $pic->carouselItems(1, 3);
$z = ['&lsaquo;', '&rsaquo;'];
echo '<pre>';
var_dump($z);
echo '</pre>';


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

<?php for ($i = 0; $i < 6; $i++) : ?>
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

            echo $i;
            $items = $pic->carouselItems($i, $id);
            echo Carousel::widget([
                'items' => $items,
                'options' => [
                    'style' => 'width: 80%; height: 400px; margin: 0 auto;',
                    'data-interval' => 'false',
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
    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>">
    <input type="submit" name="but" value="EMAIL">
</form>
