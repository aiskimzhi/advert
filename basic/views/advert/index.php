<?php

use app\models\Currency;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AdvertSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $regionList */
/* @var $cityList */
/* @var $disabled_city */
/* @var $catList */
/* @var $subcatList */
/* @var $disabled_subcat */
/* @var $beforeValue */
/* @var $afterValue */

$this->title = 'Adverts';
$dropDownItems = [
    'default' => 'Select currency',
    'uan' => 'грн.',
    'rur' => 'руб.',
    'usd' => 'USD',
    'eur' => 'EURO',
];
if (isset($_GET['currency']) && $_GET['currency'] !== 'default') {
    $cur = $_GET['currency'];
} else {
    $cur = '';
}

$sortBy = [
    '' => 'Sort by: ',
    '-updated_at' => 'Date decrement',
    'updated_at' => 'Date increment',
    '-u_price' => 'Price decrement',
    'u_price' => 'Price increment',
];
?>

<div class="advert-index">
<?php $form = ActiveForm::begin(['id' => 'form-dropdown-search', 'method' => 'get']) ?>

<div class="form-inline" style="margin-bottom: 20px;">
<?= $form->field($searchModel, 'region_id')->dropDownList($regionList,
    [
        'prompt'   => '- Choose a Region -',
        'style' => 'width: 340px;',
        'onchange' => '
                        $.ajax({
                            url: "' . Url::toRoute('get-city?id=') . '" + $(this).val(),
                            success: function( data ) {
                                $( "#' . Html::getInputId($searchModel, 'city_id') . '" )
                                .html( data ).attr("disabled", false);
                            }
                        });
                       '
    ])->label('Location: ', ['style' => 'width: 80px;']) ?>

<?= $form->field($searchModel, 'city_id')
    ->dropDownList($cityList, [
        'value' => 'null',
        'prompt' => '- Choose a City -',
        'disabled' => $disabled_city,
        'style' => 'width: 340px;',
    ])->label(' ', ['style' => 'width: 20px;']) ?>
</div>

<div class="form-inline">
<?= $form->field($searchModel, 'category_id')->dropDownList($catList,
    [
        'prompt'   => '- Choose a Category -',
        'style' => 'width: 340px;',
        'onchange' => '
                        $.ajax({
                            url: "' . Url::toRoute('get-subcat?id=') . '" + $(this).val(),
                            success: function( data ) {
                                $( "#' . Html::getInputId($searchModel, 'subcategory_id') . '" )
                                .html( data ).attr("disabled", false);
                            }
                        });
                       '
    ])->label('Category: ', ['style' => 'width: 80px;']) ?>

<?= $form->field($searchModel, 'subcategory_id')
    ->dropDownList($subcatList, [
        'value' => 'null',
        'prompt' => '- Choose a Subcategory -',
        'disabled' => $disabled_subcat,
        'style' => 'width: 340px;',
    ])->label(' ', ['style' => 'width: 20px;']) ?>
</div>

    <br>
<label class="control-label" for="before-field">Choose period: </label><br>
<div class="form-inline">
    <label class="control-label" for="before-field" style="margin-left: 30px;">From: </label>
    <?= DatePicker::widget([
        'value' => $beforeValue,
        'name' => 'before',
        'id' => 'before-field',
        'options' => ['class' => 'form-control', 'style' => 'width: 220px;']
    ]) ?>

    <label class="control-label" for="after-field">To: </label>
    <?= DatePicker::widget([
        'value' => $afterValue,
        'name' => 'after',
        'id' => 'after-field',
        'options' => ['class' => 'form-control', 'style' => 'width: 220px;']
    ]) ?>
    <?= Html::submitButton('Other period', [
        'class' => 'btn btn-primary',
        'name' => 'period',
        'value' => 'period'
    ]) ?>
</div>
<br>

<div>
    <?= Html::submitButton('Search', [
        'class' => 'btn btn-primary',
        'name' => 'search',
        'value' => 'search'
    ]) ?>
</div>

<?php ActiveForm::end(); ?>

    <br>
<div class="form-inline">
    <div class="form-group">
        <form action="" method="get" id="currency-show">
            <select id="cur-drop" class="form-control" name="currency" onchange="this.form.submit()">
                <?php foreach ($dropDownItems as $key => $val) : ?>
                    <?php if ($key == $cur) : ?>
                        <option value="<?= $key ?>" selected=""><?= $val ?></option>
                    <?php else : ?>
                        <option value="<?= $key ?>"><?= $val ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </form>
    </div>

    <div class="form-group">
        <form action="" method="get" id="sort">
            <select id="sort-drop" class="form-control" name="sort" onchange="this.form.submit()">
                <?php foreach ($sortBy as $col => $change) : ?>
                    <?php if (isset($_GET['sort']) && $_GET['sort'] == $col) : ?>
                        <option value="<?= $col ?>" selected=""><?= $change ?></option>
                    <?php else : ?>
                        <option value="<?= $col ?>"><?= $change ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </form>
    </div>
</div>

<div id="gridVew">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showHeader' => false,
        'columns' => [
            [
                'label' => 'image',
                'format' => 'raw',
                'value' => function($searchModel) {
                        return Html::img(Yii::$app->urlManager
                            ->createAbsoluteUrl($searchModel->picture($searchModel->id)), [
                            'width' => 120,
                            'height' => 120
                        ]);
                    },
                'options' => ['style' => 'width: 130px; max-width: 130px;'],
            ],
            [
                'label' => 'data',
                'format' => 'html',
                'value' => function($searchModel) {
                    $href = Url::toRoute('advert/view?id=') . $searchModel->id;
                    $text = '<div><strong style="font-size: 20px;"><a href="';
                    $text .= $href;
                    $text .= '"><font color="#000000"> ';
                    $text .= $searchModel->title;
                    $text .= '</font></a></strong></div>';
                    $text .= '<div>' . $searchModel->category->name;
                    $text .= ' » ' . $searchModel->subcategory->name;
                    $text .= '</div>';
                    $text .= '<br>';
                    $text .= '<br>';
                    $text .= '<div>' . $searchModel->region->name . ', ';
                    $text .= $searchModel->city->name . '</div>';
                    $text .= date(Yii::$app->params['dateFormat'], $searchModel->updated_at);

                    return $text;
                }
            ],
            [
                'attribute' => 'price',
                'format' => 'html',
                'value' => function($searchModel) {
                    $currency = Currency::find()->where(['>', 'date', time()])->asArray()->one();
                    $dropDownItems = [
                        'uan' => 'грн.',
                        'rur' => 'руб.',
                        'usd' => 'USD',
                        'eur' => 'EURO',
                    ];
                    if (isset($_GET['currency']) && $_GET['currency'] !== 'default') {
                        $cur = $_GET['currency'];
                    } else {
                        $cur = $searchModel->currency;
                    }
                    $price = round($searchModel->price * ($currency[$searchModel->currency] / $currency[$cur]), 2);
                    return '<h4><strong>' . $price . ' ' . $dropDownItems[$cur] . '</strong></h4>';
                },
                'options' => ['style' => 'width: 130px; max-width: 130px;'],
            ],
        ],
    ]) ?>
</div>
</div>
