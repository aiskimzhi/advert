<?php


use app\models\Currency;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BookmarkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $advert app\models\Advert */

$this->title = 'My Bookmarks';

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

<h2>My Bookmarks</h2>

<div class="my-bookmarks">
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
                            ->createAbsoluteUrl($searchModel->picture($searchModel->advert_id)), [
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
                        $href = Url::toRoute('advert/view?id=') . $searchModel->advert_id;
                        $text = '<div><strong><a href="' . $href . '"> ' . $searchModel->advert->title;
                        $text .= '</a></strong></div>';
                        $text .= '<div>' . $searchModel->advert->category->name . ' » ';
                        $text .= $searchModel->advert->subcategory->name . '</div>';
                        $text .= '<br><br>';
                        $text .= '<div>' . $searchModel->advert->region->name . ', ';
                        $text .= $searchModel->advert->city->name . '</div>';
                        $text .= date(Yii::$app->params['dateFormat'], $searchModel->advert->updated_at);

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
                            $cur = $searchModel->advert->currency;
                        }
                        $price = round($searchModel->advert->price * ($currency[$searchModel->advert->currency] / $currency[$cur]), 2);
                        return '<h4><strong>' . $price . ' ' . $dropDownItems[$cur] . '</strong></h4>';
                    },
                    'options' => ['style' => 'width: 130px; max-width: 130px;'],
                ],
                [
                    'class' => ActionColumn::className(),
                    'template' => '{delete}',
                    'options' => ['style' => 'width: 50px; max-width: 50px;'],
                ],
            ],
        ]) ?>
    </div>
</div>
