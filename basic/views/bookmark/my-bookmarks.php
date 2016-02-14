<?php


use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BookmarkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $advert app\models\Advert */

$this->title = 'My Bookmarks';
?>

<h2>My Bookmarks</h2>

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
                $value = '<h4><strong>' . $searchModel->advert->price . ' USD</strong></h4>';
                return $value;
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
