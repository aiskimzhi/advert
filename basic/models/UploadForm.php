<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFiles;
    public $avatar;

    public function rules()
    {
        return [
            [['imageFiles'], 'image', 'skipOnEmpty' => false,
                'extensions' => 'png, jpg',
                'maxFiles' => 10,
                'checkExtensionByMimeType'=>false,
            ],
        ];
    }

    public function upload($id)
    {
//        $n1 = Yii::$app->security->generateRandomString(8);
//        $n2 = Yii::$app->security->generateRandomString(2);
        if ($this->validate()) {
//            echo 'validate'; die;
            if (file_exists('img/page_' . $id)) {
                if (count(scandir('img/page_' . $id)) < Yii::$app->params['maxPics']) {
                    foreach ($this->imageFiles as $file) {
                        $file->saveAs('img/page_' . $id . '/' . Yii::$app->security->generateRandomString(8) . '_' . Yii::$app->security->generateRandomString(2) . '.' . $file->extension);
                    }
                    return true;
                } else {
//                    echo 'hmmm'; die;
                    Yii::$app->session->setFlash('error', "You can't add more that 10 pictures");
                    return false;
                }
            } else {
                mkdir('img/page_' . $id);
                foreach ($this->imageFiles as $file) {
                    $file->saveAs('img/page_' . $id . '/' . $file->baseName . '.' . $file->extension);
                }
                return true;
            }
        } else {
            return false;
        }
    }
}
