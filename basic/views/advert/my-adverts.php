<?php

use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AdvertSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'My Adverts';

echo '<h2>My Adverts</h2>';
echo Html::a('Create Advert', [Url::toRoute('advert/create')], ['class' => 'btn btn-success']);

echo '<br><br>';

echo '<div id="gridVew">';
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'showHeader' => false,
    'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '0'],
    'columns' => [
        [
            'label' => 'image',
            'format' => 'raw',
            'value' => function($searchModel) {
                $url = 'img/page_' . $searchModel->id . '/img_01.PNG';
                return Html::img(Yii::$app->urlManager->createAbsoluteUrl($url));
            },
            'options' => ['style' => 'width: 130px; max-width: 130px;'],
        ],
        [
            'label' => 'data',
            'format' => 'html',
            'value' => function($searchModel) {
                $href = Url::toRoute('advert/view?id=') . $searchModel->id;
                $text = '<div><strong><a href="' . $href . '"> ' . $searchModel->title . '</a></strong></div>';
                $text .= '<div>' . $searchModel->category->name . ' » ' . $searchModel->subcategory->name . '</div>';
                $text .= '<br>';
                $text .= '<br>';
                $text .= '<div>' . $searchModel->region->name . ', ' . $searchModel->city->name . '</div>';
                $format = 'd M Y, H:i';
                $text .= date($format, $searchModel->updated_at);

                return $text;
            }
        ],
        [
            'attribute' => 'price',
            'format' => 'html',
            'value' => function($searchModel) {
                $value = '<h4><strong>' . $searchModel->price . ' USD</strong></h4>';
                $value .= '<br><br><br>';
                $value .= 'Views: ' . $searchModel->views;
                return $value;
            },
            'options' => ['style' => 'width: 130px; max-width: 130px;'],
        ],
        [
            'class' => ActionColumn::className(),
            'options' => ['style' => 'width: 80px; max-width: 80px;'],
        ]
    ],
]);
echo '</div>';