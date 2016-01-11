<?php

//use dosamigos\gallery\Carousel;
use app\models\UploadForm;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use yii\bootstrap\Tabs;
use yii\helpers\Html;
use yii\bootstrap\Carousel;
use app\models\Pictures;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
//
//$items = [
//    [
//        'title' => 'Sintel',
//        'href' => 'http://app.dev/img/page_13/img_02.png',
//        'poster' => 'http://app.dev/img/page_13/img_02.png',
//        'src' => 'http://app.dev/img/page_13/img_02.png'
//    ],
//    [
//        'title' => 'Big Buck Bunny',
//        'href' => 'http://app.dev/img/page_13/img_03.png',
//        'poster' => 'http://app.dev/img/page_13/img_03.png'
//    ],
//];
//
//echo Carousel::widget([
//    'items' => $items,
//    'json' => true,
//    'clientEvents' => [
//        'onslide' => 'function(index, slide) {
//            console.log(slide);
//        }'
//    ]]);


//
//$items = [
//    [
//        'title' => 'Sintel',
//        'href' => 'http://app.dev/img/page_12/img_06.png',
//        'poster' => 'http://app.dev/img/page_12/img_06.png'
//    ],
//    [
//        'title' => 'Big Buck Bunny',
//        'href' => 'http://app.dev/img/page_12/img_07.png',
//        'poster' => 'http://app.dev/img/page_12/img_07.png'
//    ],
//];
//
//echo Carousel::widget([
//    'items' => $items, 'json' => true,
//    'clientEvents' => [
//        'onslide' => 'function(index, slide) {
//            console.log(slide);
//        }'
//    ]]);


//        if (file_exists('img/page_10/img_01.png')) {
//            $path = 'img/page_10/img_01.png';
//            $path_two = 'img/page_10/img_2.png';
//            $w = getimagesize($path)[0];
//            $h = getimagesize($path)[1];
//            echo 'W: ' . $w . '<br>';
//            echo 'H: ' . $h . '<br>';
//            $persent = 120 / $w;
//            echo 'persent: ' . $persent . '<br>';
//            $new_h = floor($h * $persent);
//            echo 'new_H: ' . $new_h . '<br>';
//            $a = imagecreatetruecolor(120, $new_h);
//            $b = imagecreatefrompng($path);
//            imagecopyresampled($a, $b, 0, 0, 0, 0, 120, $new_h, $w, $h);
//
//            imagepng($a);
//
//
//        } else {
//            echo 'no file found';
//        }
//
//        function resize($id)
//        {
//            $path = 'img/page_' . $id . '/img_1.png';
//            $w = getimagesize($path)[0];
//            $h = getimagesize($path)[1];
//            $persent = 120 / $w;
//            $new_h = floor($h * $persent);
//        }

//        $str = 'ab10kn';
//        $substr = substr($str, -4, 2);
//        var_dump($substr);
//        $n = intval($substr);
//        var_dump($n);
//        $k = $n + 1;
//        echo $k;


//        $path = 'img/page_10';
//        $open = opendir($path);
//        $files = readdir($open);
//        echo '<pre>';
//        $scan = scandir($path);
//        print_r(scandir($path));
//        $c = count($scan) - 2;
//        $d = 0 - $c;
//
//        $n = array_splice($scan, 2, $c);
//        print_r($n);

//
//        $substr = substr($file, -6, 2);
//        $nn = intval($substr);
//        var_dump($nn);

//        while ($files == '.') {
//            echo 'Files: ' . $files;
//        }

//        $dir = opendir($path);
//        $count = 0;
//        while($file = readdir($dir)){
//            if($file == '.' || $file == '..' || is_dir('path/to/dir' . $file)){
//                continue;
//            }
//            $count++;
//        }
//        echo 'Количество файлов: ' . $count;

?>

    <div id="gallery">
        <div>Button to add more pics</div>

        <div id="pic_1">
            <div style="width: 120px;"><img src="http://app.dev/img/page_12/img_06.png" style="width: 120px;"></div>
            <div><?php Modal::begin([
                    'header' => 'Picture',
                    'toggleButton' => ['label' => 'pic'],
                ]);

                echo Html::img('http://app.dev/img/page_12/img_06.png', ['style' => 'width:300px;']);

                Modal::end(); ?>
            </div>
        </div>
    </div>

    <div id="table">
        <table style="border: #c0c0c0; border-collapse: separate">
            <tr>
                <div class="mask-wrapper">
                    <div class="mask">
                        <button class="btn btn-success">Choose a File</button>
                        <input class="fileInputText form-hide" type="text" disabled>
                        <input type="submit" name="add" class="btn btn-success" value="Add +">
                    </div>
                    <input id="my_file" class="custom-file-input" type="file" name="my_file">
                </div>
            </tr>
            <tr>
                <td style="text-align: right; max-width: 130px; border: solid; border-color: #c0c0c0; border-width: thin">
                    <img src="http://app.dev/img/page_12/img_06.png" style="width: 120px;">
                    <br><br><br>
                    <?php Modal::begin([
                        'header' => 'Picture',
                        'toggleButton' => ['label' => '<span class="glyphicon glyphicon-eye-open"></span>'],
                    ]);

                    echo Html::img('http://app.dev/img/page_12/img_06.png', ['style' => 'width:120px;', 'class' => 'img-thumbnail']);

                    Modal::end(); ?>

                    <?= Html::button('<span class="glyphicon glyphicon-remove"></span>') ?>
                </td>
                <td style="text-align: right; max-width: 130px; border: solid; border-color: #c0c0c0; border-width: thin">
                    <img src="http://app.dev/img/page_12/img_06.png" class="img-thumbnail" style="width: 120px;">
                    <br><br><br>
                    <?php Modal::begin([
                        'header' => 'Picture',
                        'toggleButton' => ['label' => '<span class="glyphicon glyphicon-eye-open"></span>'],
                    ]);

                    echo Html::img('http://app.dev/img/page_12/img_06.png', ['style' => 'width:120px;', 'class' => 'img-thumbnail']);

                    Modal::end(); ?>

                    <?= Html::button('<span class="glyphicon glyphicon-remove"></span>') ?>
                </td>
                <td style="text-align: right; max-width: 130px; border: solid; border-color: #c0c0c0; border-width: thin">
                    <img src="http://app.dev/img/page_12/img_06.png" class="img-thumbnail" style="width: 120px;">
                    <br><br><br>
                    <?php Modal::begin([
                        'header' => 'Picture',
                        'toggleButton' => ['label' => '<span class="glyphicon glyphicon-eye-open"></span>'],
                    ]);

                    echo Html::img('http://app.dev/img/page_12/img_06.png', ['style' => 'width:120px;', 'class' => 'img-thumbnail']);

                    Modal::end(); ?>

                    <?= Html::button('<span class="glyphicon glyphicon-remove"></span>') ?>
                </td>
                <td style="text-align: right; max-width: 130px; border: solid; border-color: #c0c0c0; border-width: thin">
                    <?php Modal::begin([
                        'header' => 'Picture',
                        'toggleButton' => ['label' => '<span class="glyphicon glyphicon-eye-open"></span>'],
                    ]);

                    echo Html::img('http://app.dev/img/page_12/img_06.png', ['style' => 'width:120px;', 'class' => 'img-thumbnail']);

                    Modal::end(); ?>

                    <?= Html::button('<span class="glyphicon glyphicon-remove"></span>') ?>
                </td>
                <td style="text-align: right; max-width: 130px; border: solid; border-color: #c0c0c0; border-width: thin">
                    <?php Modal::begin([
                        'header' => 'Picture',
                        'toggleButton' => ['label' => '<span class="glyphicon glyphicon-eye-open"></span>'],
                    ]);

                    echo Html::img('http://app.dev/img/page_12/img_06.png', ['style' => 'width:120px;', 'class' => 'img-thumbnail']);

                    Modal::end(); ?>

                    <?= Html::button('<span class="glyphicon glyphicon-remove"></span>') ?>
                </td>
            </tr>
            <tr>
                <td style="text-align: right; max-width: 130px; border: solid; border-color: #c0c0c0; border-width: thin">
                    <img src="http://app.dev/img/page_12/img_06.png" class="img-thumbnail" style="width: 120px;">
                    <br><br><br>
                    <?php Modal::begin([
                        'header' => 'Picture',
                        'toggleButton' => ['label' => '<span class="glyphicon glyphicon-eye-open"></span>'],
                    ]);

                    echo Html::img('http://app.dev/img/page_12/img_06.png', ['style' => 'width:120px;', 'class' => 'img-thumbnail']);

                    Modal::end(); ?>

                    <?= Html::button('<span class="glyphicon glyphicon-remove"></span>') ?>
                </td>
                <td style="text-align: right; max-width: 130px; border: solid; border-color: #c0c0c0; border-width: thin">
                    <?php Modal::begin([
                        'header' => 'Picture',
                        'toggleButton' => ['label' => '<span class="glyphicon glyphicon-eye-open"></span>'],
                    ]);

                    echo Html::img('http://app.dev/img/page_12/img_06.png', ['style' => 'width:120px;', 'class' => 'img-thumbnail']);

                    Modal::end(); ?>

                    <?= Html::button('<span class="glyphicon glyphicon-remove"></span>') ?>
                </td>
                <td style="text-align: right; max-width: 130px; border: solid; border-color: #c0c0c0; border-width: thin">
                    <?php Modal::begin([
                        'header' => 'Picture',
                        'toggleButton' => ['label' => '<span class="glyphicon glyphicon-eye-open"></span>'],
                    ]);

                    echo Html::img('http://app.dev/img/page_12/img_06.png', ['style' => 'width:120px;', 'class' => 'img-thumbnail']);

                    Modal::end(); ?>

                    <?= Html::button('<span class="glyphicon glyphicon-remove"></span>') ?>
                </td>
                <td style="text-align: right; max-width: 130px; border: solid; border-color: #c0c0c0; border-width: thin">
                    <?php Modal::begin([
                        'header' => 'Picture',
                        'toggleButton' => ['label' => '<span class="glyphicon glyphicon-eye-open"></span>'],
                    ]);

                    echo Html::img('http://app.dev/img/page_12/img_06.png', ['style' => 'width:120px;', 'class' => 'img-thumbnail']);

                    Modal::end(); ?>

                    <?= Html::button('<span class="glyphicon glyphicon-remove"></span>') ?>
                </td>
                <td style="text-align: right; max-width: 130px; border: solid; border-color: #c0c0c0; border-width: thin">
                    <?php Modal::begin([
                        'header' => 'Picture',
                        'toggleButton' => ['label' => '<span class="glyphicon glyphicon-eye-open"></span>'],
                    ]);

                    echo Html::img('http://app.dev/img/page_12/img_06.png', ['style' => 'width:120px;', 'class' => 'img-thumbnail']);

                    Modal::end(); ?>

                    <?= Html::button('<span class="glyphicon glyphicon-remove"></span>') ?>
                </td>
            </tr>
        </table>
    </div>

<?php

$scan = scandir('img/page_12');
var_dump($scan);

Modal::begin([
    'header' => 'Picture',
    'toggleButton' => [
        'label' => '<span class="glyphicon glyphicon-eye-open"></span>',
        'style' => 'display: none'
    ],
]);

echo Html::img('http://app.dev/img/page_12/img_06.png', ['style' => 'width:120px;', 'class' => 'img-thumbnail']);

Modal::end();

echo Html::button('<span class="glyphicon glyphicon-remove"></span>');

//Modal::begin(['header' => 'Picture', 'toggleButton' => ['label' => '<span class="glyphicon glyphicon-eye-open"></span>']]);

$items = [
    [
        'content' => Html::img('img/page_1/' . scandir('img/page_1')[2]),
    ],
    [
        'content' => Html::img('img/page_1/' . scandir('img/page_1')[3]),
    ],
    [
        'content' => Html::img('img/page_1/' . scandir('img/page_1')[4]),
    ],
    [
        'content' => Html::img('img/page_1/' . scandir('img/page_1')[5]),
    ],
    [
        'content' => Html::img('img/page_1/' . scandir('img/page_1')[6]),
    ],
];
//echo '<pre>';
//print_r($items);
//echo '</pre>';
//echo Carousel::widget([
//    'items' => $items,
//]);

//Modal::end();

$vis = [
    'display: none',
    'display: none',
    'display: none',
    'display: none',
    'display: none',
    'display: none',
    'display: none',
    'display: none',
    'display: none',
    'display: none',
];

for ($i = 0; $i < count(scandir('img/page_1')) - 3; $i++) {
    $vis[$i] = 'visibility: visible';
}


?>
    <!--
<table>
    <tr>
        <td style="<?= $vis[0] ?>; border: solid; border-color: #c0c0c0; border-width: thin; vertical-align: top">ha-3<br><br><br><br></td>
        <td style="<?= $vis[1] ?>; border: solid; border-color: #c0c0c0; border-width: thin; vertical-align: top">ha-4<br><br></td>
        <td style="<?= $vis[2] ?>; border: solid; border-color: #c0c0c0; border-width: thin; vertical-align: top">ha-5<br></td>
        <td style="<?= $vis[3] ?>; border: solid; border-color: #c0c0c0; border-width: thin; vertical-align: top">ha-6</td>
        <td style="<?= $vis[4] ?>; border: solid; border-color: #c0c0c0; border-width: thin; vertical-align: top">ha-7</td>
    </tr>
    <tr>
        <td style="<?= $vis[5] ?>; border: solid; border-color: #c0c0c0; border-width: thin;">ha-8</td>
        <td style="<?= $vis[6] ?>; border: solid; border-color: #c0c0c0; border-width: thin;">ha-9</td>
        <td style="<?= $vis[7] ?>; border: solid; border-color: #c0c0c0; border-width: thin;">ha-10</td>
        <td style="<?= $vis[8] ?>; border: solid; border-color: #c0c0c0; border-width: thin;">ha-11</td>
        <td style="<?= $vis[9] ?>; border: solid; border-color: #c0c0c0; border-width: thin;"></td>
    </tr>
</table>
-->
<?php
$m = new Pictures();
$imgModel = new UploadForm();
//echo '<pre>';
//print_r($m->addItem());
//echo '</pre>';

//echo $m->addItem($imgModel);
?>
    <!--
    <div class="btn btn-success" style="width: 100px; height: 50px; position: relative; z-index: -2; margin-top: -250px;"></div>
    <div class="btn btn-info" style="width: 100px; height: 100px; position: relative; z-index: 4; margin-left: -50px;"></div>
    <div class="btn btn-danger" style="width: 100px; height: 100px; position: relative; margin-left: -50px; z-index: 5;"></div>
    <div class="btn btn-primary" style="width: 100px; height: 100px; position: relative; opacity: 0.5"></div>


    <form id="add-picture" enctype="multipart/form-data" method="post">
       <div class="mask-wrapper">
            <div class="mask">
                <button class="btn btn-success">Choose a File</button>
                <input class="fileInputText form-hide" type="text" disabled>
                <input type="submit" name="add" class="btn btn-success" value="Add +">
               </div>
            <input id="my_file" class="custom-file-input" type="file" name="my_file">
            </div>
        </form>
    -->

<?php

echo '<div>';
$form = ActiveForm::begin(['id' => 'add-picture', 'options' => ['enctype' => 'multipart/form-data']]);

echo $form->field($imgModel, 'imageFile')->fileInput([
    'value' => 'choose',
    'style' => 'opacity: 0; z-index: 3; position: relative;',
])->label(false);

echo Html::beginTag('div', [
    'class' => 'btn btn-success',
    'id' => 'uploadform-imagefile',
    'style' => 'position: relative; margin-top: -120px; margin-left: -12px; z-index: 1;'
]);
echo 'Choose a picture';
echo Html::endTag('div');
echo Html::submitButton('Add picture', [
    'class' => 'btn btn-success',
    'style' => 'position: relative; margin-top: -120px; margin-left: 100px;'
]);

ActiveForm::end();
echo '</div>';
