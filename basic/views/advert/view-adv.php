<?php

//use byii\bootstrap\Carousel;
use yii\bootstrap\Carousel;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Advert */
/* @var $buttons */
/* @var $value */

$this->title = $model->title;

if (file_exists('img/page_' . $model->id)) {
    $img = count(scandir('img/page_' . $model->id)) - 2;
} else {
    $img = 0;
}

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

<div class="advert-view">

<div><h4><?= $model->category->name ?>  » <?= $model->subcategory->name ?></h4></div>

<h2><strong><?= $model->title ?></strong></h2>

<h4><?= $model->region->name ?>, <?= $model->city->name ?></h4>

<p><em>Last update: <?= date(Yii::$app->params['dateFormat'], $model->updated_at) ?></em></p>

<div><?= $model->text ?></div>

<br><br>
<p style="clear: both"><em><strong>Contact the author: </strong></em></p>
<p><strong>
    <a href="<?= Url::toRoute(['site/contact-author?id=']) . $model->id ?>">Write an email</a>
</strong></p>
<p><strong>Phone: </strong> <?= $model->user->phone ?></p>
<p><strong>Skype: </strong> <?= $model->user->skype ?></p>


<p>
<?php $url = Url::toRoute('bookmark/add-to-bookmarks?id=') . $model->id; ?>
<?= Html::input('submit', 'button', $value,
    [
        'id' => 'book',
        'class' => 'btn btn-create',
        'onclick' => '
                        $.ajax({
                        url: "' . $url . '",
                        success: function ( data ) {
                            $( "#book" ).html( data ).attr("value", data );
                        }
                        })
                    '
    ])
?>
</p>

</div>
<!--
<button onclick="avatar()">HOHO</button>

<form action="" method="get">
    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>">
    <input type="submit" name="del" value="DELETE" id="blabla">
    <input type="hidden" name="del-hidden" value="val">
    <input type="submit" name="avatar" value="AVATAR" id="avatar">
    <input type="hidden" name="avatar-hidden" value="AVATAR">
    <input type="hidden" name="id" value="<?= $model->id ?>">
</form>
-->

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

    <?php for ($i = 0; $i < $img; $i++) : ?>
        <div class="border" style="<?= $border ?>">
            <img src="<?= $pic->imgList($_GET['id'])[$i] ?>" style="max-width: 150px; max-height: 150px;">

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
                        'onclick' => 'carouselOpen(' . $i . ')',
                    ],
//                'options' => ['style' => 'width: 500px;']
                ]);

                echo $i;
                $items = $pic->carouselItems($i, $_GET['id']);
                echo Carousel::widget([
                    'id' => 'car' . $i,
                    'items' => $items,
                    'options' => [
                        'style' => 'width: 80%; height: 400px; margin: 0 auto;',
                        'data-interval' => 'false',
                    ],
                ]);

                $adr = Url::toRoute('modal?id=' . $model->id);
                $data = "img=$('#avatar_1').attr('value')";
                ?>

                <button onmouseover="getImage(<?= $i ?>)" id="av_<?= $i ?>" onclick="setAvatar(<?= $model->id ?>, <?= $i ?>)">AVATAR</button><br>


                <form action="" method="post">
                    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>">
                    <input type="submit" name="del" value="DELETE" onmouseover="getImage(<?= $i ?>)">
                    <input type="hidden" name="avatar-hidden" value="HIDDEN" id="avatar_<?= $i ?>">
                </form>

                <?php Modal::end(); ?>
            </div>
        </div>
    <?php endfor; ?>
</div>

<form action="" method="post" id="f1">
    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>">
    <input type="submit" name="avatar" value="AVATAR">
    <input type="text" name="avatar-hidden" value="HIDDEN" id="avatar">
</form>

