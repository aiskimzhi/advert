<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AdvertSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Adverts';
?>

<div class="advert-index">
<?php $form = ActiveForm::begin(['id' => 'form-dropdown-search', 'method' => 'get']) ?>

<div class="form-inline">
<?= $form->field($searchModel, 'region_id')->dropDownList($regionList,
    [
        'prompt'   => '- Choose a Region -',
        'style' => 'width: 220px;',
        'onchange' => '
                        $.ajax({
                            url: "' . Url::toRoute('get-city?id=') . '" + $(this).val(),
                            success: function( data ) {
                                $( "#' . Html::getInputId($searchModel, 'city_id') . '" )
                                .html( data ).attr("disabled", false);
                            }
                        });
                       '
    ])->label('Location: ') ?>

<?= $form->field($searchModel, 'city_id')
    ->dropDownList($cityList, [
        'value' => 'null',
        'prompt' => '- Choose a City -',
        'disabled' => $disabled_city,
        'style' => 'width: 220px; margin-left: 25px;',
    ])->label(false) ?>
</div>'

<div class="form-inline">
<?= $form->field($searchModel, 'category_id')->dropDownList($catList,
    [
        'prompt'   => '- Choose a Category -',
        'style' => 'width: 220px;',
        'onchange' => '
                        $.ajax({
                            url: "' . Url::toRoute('get-subcat?id=') . '" + $(this).val(),
                            success: function( data ) {
                                $( "#' . Html::getInputId($searchModel, 'subcategory_id') . '" )
                                .html( data ).attr("disabled", false);
                            }
                        });
                       '
    ])->label('Category: ') ?>

<?= $form->field($searchModel, 'subcategory_id')
    ->dropDownList($subcatList, [
        'value' => 'null',
        'prompt' => '- Choose a Subcategory -',
        'disabled' => $disabled_subcat,
        'style' => 'width: 220px; margin-left: 25px;',
    ])->label(false) ?>
</div>

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
                    $value = '<h4><strong>' . $searchModel->price . ' USD</strong></h4>';
                    return $value;
                },
                'options' => ['style' => 'width: 130px; max-width: 130px;'],
            ],
        ],
    ]) ?>
</div>
</div>
