<?php

//use byii\bootstrap\Carousel;
use yii\bootstrap\Carousel;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\widgets\DetailView;
use app\models\Currency;

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
        background-color: #fff;
        border-color: #337ab7;';
$view = 'position: absolute;
        bottom: 0;
        right: 30px;
        border: solid;
        height: 30px;
        width: 30px;
        background-color: #fff;
        border-color: #337ab7;
        margin-right: 5px;';
$s = 'background-size: cover;
        width: 150px;
        height: 150px;';

if (isset($_GET['currency'])) {
    $cur = $_GET['currency'];
} else {
    $cur = $model->currency;
}
$currency = Currency::find()->where(['>', 'date', time()])->asArray()->one();

$dropDownItems = [
    'uan' => 'грн.',
    'rur' => 'руб.',
    'usd' => 'USD',
    'eur' => 'EUR',
];

$price = round($model->price * ($currency[$model->currency] / $currency[$cur]), 2);

$contacts = [
    'Phone: ' => $model->user->phone,
    'Skype: ' => $model->user->skype,
];
?>

<div class="advert-view">

<div><h4><?= $model->category->name ?>  » <?= $model->subcategory->name ?></h4></div>

<h2><strong><?= $model->title ?></strong></h2>

<h4><?= $model->region->name ?>, <?= $model->city->name ?></h4>

<p><em>Last update: <?= date(Yii::$app->params['dateFormat'], $model->updated_at) ?></em></p>

<div class="gallery" style="width: 70%; overflow: hidden; position: relative; display: block;">

    <?php for ($i = 0; $i < $img; $i++) : ?>
        <div class="border" style="<?= $border ?>">

            <div id="view">
                <?php Modal::begin([
                    'size' => 'modal-lg',
                    'toggleButton' => [
                        'label' => '',
                        'style' => 'background: url(' . $pic->imgList($_GET['id'])[$i] . ') no-repeat 50%;' . $s,
                        'class' => 'carousel-but',
                        'onclick' => 'carouselOpen(' . $i . ')',
                    ],
                ]);

                $items = $pic->carouselItems($i, $_GET['id']);
                echo Carousel::widget([
                    'id' => 'car' . $i,
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
</div>

<div style="border: solid 2px #d9e9ff; background-color: #e9e9e9;"><?= $model->text ?></div>

<div class="form-inline">
    <form action="" method="get">
        <label for="cur-drop" class="control-label"><h4>Price: <?= $price ?></h4></label>
        <select id="cur-drop" class="form-control" name="currency" onchange="this.form.submit()">
            <?php
            foreach ($dropDownItems as $key => $val) {
                if ($key == $cur) {
                    echo '<option value="' . $key . '" selected="">' . $val . '</option>';
                } else {
                    echo '<option value="' . $key . '">' . $val . '</option>';
                }
            }
            ?>
        </select>
        <input type="hidden" name="id" value="<?= $model->id ?>">
    </form>
</div>

<br><br>

<p style="clear: both"><em><strong>Contact the author: </strong></em></p>
<p><strong>
    <a href="<?= Url::toRoute(['site/contact-author?id=']) . $model->id ?>">Write an email</a>
</strong></p>
<?php foreach ($contacts as $mean => $contact) : ?>
    <?php if (!empty($contact)) : ?>
        <p><strong><?= $mean ?></strong><?= $contact ?></p>
    <?php endif; ?>
<?php endforeach; ?>


<p>
<?php $url = Url::toRoute('bookmark/add-to-bookmarks?id=') . $model->id; ?>
<?= Html::input('submit', 'button', $value,
    [
        'id' => 'book',
        'class' => 'btn btn-primary',
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
