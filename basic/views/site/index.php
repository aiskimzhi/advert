<?php

/* @var $this yii\web\View */

use app\models\Currency;
use app\models\Views;
use yii\helpers\Url;

$this->title = 'start again';

if (Yii::$app->user->isGuest) {
    $href = Url::toRoute(['site/signup']);
    $msg = 'SIGN UP AND PLACE YOUR ADVERTS';
} else {
    $href = Url::toRoute(['advert/create']);
    $msg = 'CREATE YOUR ADVERT';
}

echo date(Yii::$app->params['dateFormat'], 1456272000);
?>

<div class="jumbotron">
    <p>
        <a class="btn btn-lg btn-info" href="<?= $href ?>"><?= $msg ?></a>
    </p>
</div>
