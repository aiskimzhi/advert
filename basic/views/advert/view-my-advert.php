<?php

use app\models\Currency;
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
/* @var $value */

$this->title = $model->title;

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
?>
<div class="advert-view">

    <div><h4> <?= $model->category->name ?>  »  <?= $model->subcategory->name ?> </h4></div>

    <h2> <?= $model->title ?> </h2>

    <h4> <?= $model->region->name ?> ,  <?= $model->city->name ?> </h4>

    <p><em>Last update: <?= date(Yii::$app->params['dateFormat'], $model->updated_at) ?></em></p>

<div class="gallery" style="width: 70%; overflow: hidden; position: relative; display: block;">

<?php
    if (file_exists('img/page_' . $model->id)) {
        $img = count(scandir('img/page_' . $model->id)) - 2;
    } else {
        $img = 0;
    }
?>

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
?>

    <?php for ($i = 0; $i < $img; $i++) : ?>
        <div class="border" style="<?= $border ?>">

            <div id="del">
                <?php $span = '<span class="glyphicon glyphicon-trash" style="color: #337ab7; background-color: #fff;"></span>'; ?>
                <?= Html::submitButton($span, ['style' => $del]) ?>
            </div>

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
                ]); ?>

                <div style="width: 80%; position: relative; height: 100px; margin: 0 auto; padding-top: 10px;">
                    <div style="margin: 0 0 auto auto; width: 171px; height: 40px;">
                        <button onmouseover="getImage(<?= $i ?>)" id="av_<?= $i ?>"
                                onclick="setAvatar(<?= $model->id ?>, <?= $i ?>)"
                                class="btn btn-primary">Set as the main picture</button>
                    </div>

                    <div style="margin: 0 0 auto auto; width: 171px; height: 40px;">
                        <form action="" method="post" id="fm">
                            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>">
                            <input type="submit" name="del" value="Delete picture"
                                   onmouseover="getImage(<?= $i ?>)"
                                   class="btn btn-danger" style="width: 171px;">
                            <input type="hidden" name="delete" value="HIDDEN" id="avatar_<?= $i ?>">
                        </form>
                    </div>
                </div>

                <?php Modal::end(); ?>
            </div>
        </div>
    <?php endfor; ?>
</div>



</div>


<?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data'],
]) ?>

<?= $form->field($imgModel, 'imageFiles[]')->widget(FileInput::classname(), [
    'options' => ['multiple' => true],
    'pluginOptions' => ['previewFileType' => 'any']
])->label('Add images') ?>

<?php ActiveForm::end(); ?>


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

<div style="margin-top: 25px; margin-bottom: 20px;">
    <p style="clear: both"><em><strong>My contacts: </strong></em></p>
    <p><strong>E-mail: </strong><?= $model->user->email ?></p>
    <p><strong>Phone: </strong><?= $model->user->phone ?></p>
    <p><strong>Skype: </strong><?= $model->user->skype ?></p>
</div>

<div style="clear: both">
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
    <?= Html::a('Update advert', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Delete advert', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Are you sure you want to delete this advert?',
            'method' => 'post',
        ],
    ]) ?>
</div>
