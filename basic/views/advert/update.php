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

    <?= $form->field($model, 'category_id')->dropDownList($catList,
        [
            'prompt'   => '- Choose a Category -',
            'onchange' => '
                            $.ajax({
                                url: "' . Url::toRoute('get-subcat?id=') . '" + $(this).val(),
                                success: function( data ) {
                                    $( "#' . Html::getInputId($model, 'subcategory_id') . '" )
                                    .html( data ).attr("disabled", false);
                                }
                            });
                           '
        ]) ?>

    <?= $form->field($model, 'subcategory_id')->dropDownList($subcatList) ?>

    <?= $form->field($model, 'region_id')->dropDownList($regionList,
        [
            'prompt'   => '- Choose a Region -',
            'onchange' => '
                            $.ajax({
                                url: "' . Url::toRoute('get-city?id=') . '" + $(this).val(),
                                success: function( data ) {
                                    $( "#' . Html::getInputId($model, 'city_id') . '" )
                                    .html( data ).attr("disabled", false);
                                }
                            });
                           '
        ]) ?>

    <?= $form->field($model, 'city_id')->dropDownList($cityList) ?>
    <?= $form->field($model, 'title')->textInput() ?>
    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'price')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Update Advert', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
