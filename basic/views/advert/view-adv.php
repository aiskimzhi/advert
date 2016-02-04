<?php

use yii\bootstrap\Carousel;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Advert */
/* @var $buttons */
/* @var $value */

$this->title = $model->title;

if (file_exists('img/page_' . $model->id)) {
    $img = count(scandir('img/page_' . $model->id)) - 2;
} else {
    $img = 0;
}

$border = 'float: left;
        border: solid;
        border-width: 1px;
        border-color: #808080;
        width: 154px; max-width: 154px; min-width: 154px;
        height: 190px; max-height: 190px; min-height: 190px;
        position: relative;
        margin-right: 5px;
        margin-bottom: 5px;';
$del = 'position: absolute;
        bottom: 0;
        right: 0;
        border: solid;
        height: 30px;
        width: 30px;
        background-color: #000000;
        border-color: #f3dc0f;';
$view = 'position: absolute;
        bottom: 0;
        right: 30px;
        border: solid;
        height: 30px;
        width: 30px;
        background-color: #000000;
        border-color: #f3dc0f;
        margin-right: 5px;';

?>
<div class="advert-view">

<div><h4><?= $model->category->name ?>  » <?= $model->subcategory->name ?></h4></div>

<h2><strong><?= $model->title ?></strong></h2>

<h4><?= $model->region->name ?>, <?= $model->city->name ?></h4>

<p><em>Last update: <?= date(Yii::$app->params['dateFormat'], $model->updated_at) ?></em></p>

<div><?= $model->text ?></div>

    <div style="max-width: 800px">
        <?php for ($i = 0; $i < $img; $i++) : ?>
            <div class="border" style="<?= $border ?>">
                <img src="<?= $pic->imgList($model->id)[$i] ?>" style="max-width: 150px; max-height: 150px;">

                <div id="del">
                    <?php $span = '<span class="glyphicon glyphicon-remove" style="color: #f3dc0f; background-color: #000000;"></span>'; ?>
                    <form action="" method="post">
                        <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>">
                        <?= Html::submitButton($span, ['name' => 'delete',
                            'value' => array_splice(scandir('img/page_' . $model->id), 2)[$i],
                            'style' => $del
                        ]) ?>
                        <!-- <input type="submit" name="delete" value=""> -->
                    </form>


                </div>

                <div id="view">
                    <?php Modal::begin([
                        'size' => 'modal-lg',
                        'toggleButton' => [
                            'label' => '<span class="glyphicon glyphicon-search" style="color: #f3dc0f; background-color: #000000;"></span>',
                            'style' => $view,
                        ],
//                'options' => ['style' => 'width: 500px;']
                    ]);

                    $items = $pic->carouselItems($i, $model->id);
                    echo Carousel::widget([
                        'items' => $items,
                        'options' => [
                            'style' => 'width: 80%; height: 400px; margin: 0 auto;',
                        ],
                    ]);

                    Modal::end(); ?>
                </div>
            </div>
        <?php endfor; ?>
    </div>





<p style="clear: both"><em>Contact the author: </em></p>
<p><strong>E-mail: </strong> <?= $model->user->email ?></p>
<p><strong>Phone: </strong> <?= $model->user->phone ?></p>
<p><strong>Skype: </strong> <?= $model->user->skype ?></p>


<p>
<?php $url = Url::toRoute('bookmark/add-to-bookmarks?id=') . $model->id; ?>
<?= Html::input('submit', 'button', $value,
    [
        'id' => 'book',
        'class' => 'btn btn-create',
        'onclick' => '
                        $.ajax({
                        url: "' . $url . '",
                        success: function ( data ) {
                            $( "#book" ).html( data ).attr("value", data );
                        }
                        })
                    '
    ])
?>
</p>

</div>
