<?php

use app\models\Advert;
use app\models\AdvertSearch;
use app\models\Bookmark;
use app\models\Currency;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;

$columns = [
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
    [
        'attribute' => 'price',
        'format' => 'html',
        'value' => function($searchModel) {
            $span = '<span class="glyphicon glyphicon-trash"></span>';
            $url = Url::toRoute(['bookmark/delete-bm', 'advert_id' => $searchModel->id]);
            return Html::a($span, [$url]);
        }
    ],
];



$searchModel = new AdvertSearch();
$book = Bookmark::find()->where(['user_id' => Yii::$app->user->identity->getId()])->asArray()->all();
$n = count($book);
$arr = [0];
for ($i = 0; $i < $n; $i++) {
    $arr[$i] = $book[$i]['advert_id'];
}

$query = Advert::find()->andFilterWhere(['IN', 'id', $arr]);

$dataProvider = new ActiveDataProvider([
    'query' => $query,
]);

echo $this->render('_try', [
    'searchModel' => $searchModel,
    'dataProvider' => $dataProvider,
    'columns' => $columns,
]);
