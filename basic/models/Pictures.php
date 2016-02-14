<?php

namespace app\models;

use app\models\Advert;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Html;

class Pictures extends Advert
{
    /**
     * @param $id
     * @return array
     * Gets the list of images in directory
     */
    public function imgList($id)
    {
        $list = [];
        if (file_exists('img/page_' . $id)) {
            if (count(scandir('img/page_' . $id)) > 2) {
                $max = count(scandir('img/page_' . $id)) - 2;
                $names = array_splice(scandir('img/page_' . $id), 2, $max);
                for ($i = 0; $i < $max; $i++) {
                    $list[$i] = '/img/page_' . $id . '/' . $names[$i];
                }
                return $list;
            }
        }
        return $list;
    }

    /**
     * @param $i
     * @param $id
     * @return array
     * returns items of carousel for a certain image
     */
    public function carouselItems($i, $id)
    {
        $items = [];
        $arr1 = array_splice($this->imgList($id), $i);
        $arr2 = array_splice($this->imgList($id), 0, $i);
        $array = array_merge($arr1, $arr2);

        for ($j = 0; $j < count($array); $j++) {
            $items[$j] =  Html::img($array[$j], [
                'style' => 'max-width: 600px; max-height: 400px; margin: 0 auto;',
                'class' => 'item',
                'id' => $i . $j,
            ]);
        }

        return $items;
    }

    /**
     * @param $id
     * @return mixed
     * returns value for deleting picture
     */
    public function value($id)
    {
        $val = ['', '', '', '', '', '', '', '', '', ''];
        for ($i = 0; $i < 10; $i++) {
            if (file_exists('img/page_' . $id)) {
                if ($i < count(scandir('img/page_' . $id)) - 2) {
                    $val[$i] = 'img/page_' . $id . '/' . $this->imgList($id)[$i];
                } else {
                    $val[$i] = '';
                }
            }
        }
        return $val;
    }

    /**
     * @param $id
     * @return mixed
     * returns image to render in the table
     */
    public function image($id)
    {
        $img = ['', '', '', '', '', '', '', '', '', ''];
        for ($i = 0; $i < 10; $i++) {
            if (file_exists('img/page_' . $id)) {
                if ($i < count(scandir('img/page_' . $id)) - 2) {
                    $img[$i] = '<img src="/img/page_' . $id . '/' . $this->imgList($id)[$i] . '" style="width: 120px; height: 120px; vertical-align: top">';
                } else {
                    $img[$i] = '';
                }
            }
        }
        return $img;
    }
}
