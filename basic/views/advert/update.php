<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Advert */
/* @var $catList */
/* @var $subcatList */
/* @var $regionList */
/* @var $cityList */

$this->title = 'Update Advert: ' . ' ' . $model->title;
?>

<div class="advert-update">

    <?php $form = ActiveForm::begin(['id' => 'form']); ?>

        <div class="form-inline">
            <?= $form->field($model, 'region_id')->dropDownList($regionList,
                [
                    'style' => 'width: 300px;',
                    'onchange' => '
                                    $.ajax({
                                        url: "' . Url::toRoute('get-city?id=') . '" + $(this).val(),
                                        success: function( data ) {
                                            $( "#' . Html::getInputId($model, 'city_id') . '" )
                                            .html( data ).attr("disabled", false);
                                        }
                                    });
                                   '
                ])->label('Location: ') ?>

            <?= $form->field($model, 'city_id')
                ->dropDownList($cityList, ['style' => 'width: 300px;'])->label(false) ?>
        </div>

        <div class="form-inline">
            <?= $form->field($model, 'category_id')->dropDownList($catList,
                [
                    'style' => 'width: 300px;',
                    'onchange' => '
                                    $.ajax({
                                        url: "' . Url::toRoute('get-subcat?id=') . '" + $(this).val(),
                                        success: function( data ) {
                                            $( "#' . Html::getInputId($model, 'subcategory_id') . '" )
                                            .html( data ).attr("disabled", false);
                                        }
                                    });
                                   '
                ])->label('Category: ') ?>

            <?= $form->field($model, 'subcategory_id')
                ->dropDownList($subcatList, ['style' => 'width: 300px;'])->label(false) ?>
        </div>

        <div id="advert-create">
            <?= $form->field($model, 'title')->textInput() ?>

            <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

            <div class="form-inline">
                <?= $form->field($model, 'price')->textInput() ?>

                <?= $form->field($model, 'currency')->dropDownList([
                    '' => 'Select currency',
                    'uan' => 'грн.',
                    'rur' => 'руб.',
                    'usd' => 'USD',
                    'eur' => 'EURO',
                ])->label(false) ?>
            </div>

        </div>

        <div class="form-group">
            <?= Html::submitButton('Update Advert', ['class' => 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
