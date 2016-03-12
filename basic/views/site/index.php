<?php

/* @var $this yii\web\View */

use app\models\Currency;
use app\models\Pictures;
use app\models\Views;
use yii\bootstrap\Carousel;
use yii\bootstrap\Modal;
use yii\helpers\Url;

$this->title = 'start again';

$border = 'float: left;
        border: solid;
        border-width: 1px;
        border-color: #808080;
        width: 154px; max-width: 154px; min-width: 154px;
        height: 190px; max-height: 190px; min-height: 190px;
        position: relative;
        margin-right: 5px;
        margin-bottom: 5px;';

$filename = 'img/page_3/3.png';

$style = 'background: url(img/page_3/4.png) no-repeat 50%;
        background-size: cover;
        width: 300px;
        height: 300px;';

$s = 'background-size: cover;
        width: 150px;
        height: 150px;';

Modal::begin([
    'size' => 'modal-lg',
    'toggleButton' => [
        'label' => '',
        'style' => $style,
        'class' => 'carousel-but',
//        'onclick' => 'carouselOpen(' . $i . ')',
    ],
]);

Modal::end();

$pic = new Pictures();
?>

<div class="gallery" style="width: 70%; overflow: hidden; position: relative; display: block;">

    <?php for ($i = 0; $i < 3; $i++) : ?>
    <div class="border" style="<?= $border ?>">
        <!-- <img src="<?= $pic->imgList(30)[$i] ?>" style="max-width: 150px; max-height: 150px;" -->

        <div id="view">
            <?php Modal::begin([
                'size' => 'modal-lg',
                'toggleButton' => [
                    'label' => '',
                    'style' => 'background: url(' . $pic->imgList(30)[$i] . ') no-repeat 50%;' . $s,
                    'class' => 'carousel-but',
                    'onclick' => 'carouselOpen(' . $i . ')',
                ],
            ]);

            $items = $pic->carouselItems($i, 30);
            echo Carousel::widget([
                'id' => 'car' . $i,
                'items' => $items,
                'options' => [
                    'style' => 'width: 80%; height: 400px; margin: 0 auto;',
                    'data-interval' => 'false',
                ],
            ]);

            Modal::end(); ?>
        </div>
    </div>
<?php endfor; ?>
</div>

<?php

echo '<pre>';
print_r(scandir('img/page_3'));
echo '</pre>';

for ($i = 2; $i < 6; $i++) {
    $img[$i] = 'img/page_3/' . scandir('img/page_3')[$i];
    $w[$i] = getimagesize($img[$i])[0];
    $h[$i] = getimagesize($img[$i])[1];
    $per[$i] = 150 / $h[$i];
    $n_w[$i] = $w[$i] * $per[$i];
    echo 'Size: ' . $w[$i] . ' x ' . $h[$i] . '. Per: ' . $per[$i] . ' N_W: ' . $n_w[$i] . '<br>';
}

echo '<pre>';
print_r(array_sum($n_w));
echo '</pre>';

$a = 221 + 267;
echo '221 + 267 = ' . $a . '<br>';
$b = round((770 / $a), 2);
echo $b . '<br>';

$w1 = round(($n_w[2] * $b), 2);
$w2 = round(($n_w[3] * $b), 2);
$ww = $w1 + $w2;
echo $ww . '<br>';

$yy = $w2 / $w[3] * $h[3];
echo 'N_H = ' . $yy;
