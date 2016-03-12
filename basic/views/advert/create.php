<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use app\models\User;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Advert */
/* @var $user app\models\User */
/* @var $pic app\models\UploadForm */

$this->title = 'Create Advert';
?>


<?php $form = ActiveForm::begin(['id' => 'create-advert-form']); ?>

<div class="form-inline">
    <?= $form->field($model, 'category_id')->dropDownList($catList,
        [
            'prompt'   => '- Choose a Category -',
            'style' => 'width: 340px;',
            'onchange' => '
                            $.ajax({
                                url: "' . Url::toRoute('get-subcat?id=') . '" + $(this).val(),
                                success: function( data ) {
                                    $( "#' . Html::getInputId($model, 'subcategory_id') . '" )
                                    .html( data ).attr("disabled", false);
                                }
                            });
                           '
        ])->label('Category: ', ['style' => 'width: 80px;']) ?>

    <?= $form->field($model, 'subcategory_id')
        ->dropDownList(
            ['id' => '- Choose a Sub-category -'],
            [
                'disabled' => 'disabled',
                'style' => 'width: 340px;'
            ]
        )->label(' ', ['style' => 'width: 20px;']) ?>
</div>

<div class="form-inline">
    <?= $form->field($model, 'region_id')->dropDownList($regionList,
        [
            'prompt'   => '- Choose a Region -',
            'style' => 'width: 340px;',
            'onchange' => '
                            $.ajax({
                                url: "' . Url::toRoute('get-city?id=') . '" + $(this).val(),
                                success: function( data ) {
                                    $( "#' . Html::getInputId($model, 'city_id') . '" )
                                    .html( data ).attr("disabled", false);
                                }
                            });
                           '
        ])->label('Location: ', ['style' => 'width: 80px;']) ?>

    <?= $form->field($model, 'city_id')
        ->dropDownList(
            ['id' => '- Choose a City -'],
            [
                'disabled' => 'disabled',
                'style' => 'width: 340px;'
            ]
        )->label(' ', ['style' => 'width: 20px;']) ?>
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
            'eur' => 'EUR',
        ])->label(false) ?>
    </div>

</div>

<div class="form-group">
    <?= Html::submitButton('Create Advert', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
