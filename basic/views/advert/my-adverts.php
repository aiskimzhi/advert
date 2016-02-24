<?php

use app\models\Currency;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AdvertSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'My Adverts';

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
?>

<h2>My Adverts</h2>
<?= Html::a('Create Advert', [Url::toRoute('advert/create')], ['class' => 'btn btn-primary']) ?>

<br><br>

<div class="form-inline">
    <div class="form-group">
        <form action="" method="get" id="currency-show">
            <!-- <label for="cur-drop" class="control-label">Select currency</label> -->
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
</div>

<br>

<div id="gridVew">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showHeader' => false,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '0'],
        'columns' => [
            [
                'label' => 'image',
                'format' => 'raw',
                'value' => function($searchModel) {
                    return Html::img(Yii::$app->urlManager
                        ->createAbsoluteUrl($searchModel->picture($searchModel->id)), [
                        'style' => 'max-width: 120px;'
                    ]);
                },
                'options' => ['style' => 'width: 130px; max-width: 130px;'],
            ],
            [
                'label' => 'data',
                'format' => 'html',
                'value' => function($searchModel) {
                    $href = Url::toRoute('advert/view?id=') . $searchModel->id;
                    $text = '<div><strong><a href="';
                    $text .= $href . '"> ' . $searchModel->title . '</a></strong></div>';
                    $text .= '<div>' . $searchModel->category->name;
                    $text .= ' » ' . $searchModel->subcategory->name . '</div>';
                    $text .= '<br>';
                    $text .= '<br>';
                    $text .= '<div>' . $searchModel->region->name;
                    $text .= ', ' . $searchModel->city->name . '</div>';
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

                    $text = '<h4><strong>' . $price . ' ' . $dropDownItems[$cur] . '</strong></h4>';
                    $text .= '<br><br><br>';
                    $text .= 'Views: ' . $searchModel->views;
                    return $text;
//                    return '<h4><strong>' . $price . ' ' . $dropDownItems[$cur] . '</strong></h4>';
                },
                'options' => ['style' => 'width: 130px; max-width: 130px;'],
            ],
            [
                'class' => ActionColumn::className(),
                'options' => ['style' => 'width: 80px; max-width: 80px;'],
            ]
        ],
    ]) ?>
</div>
