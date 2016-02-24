<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;


$template = [
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
];

?>

<div class="gridView">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showHeader' => false,
        'columns' => array_merge($template, $columns),
    ]) ?>
</div>
