<?php

namespace app\models;

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

    public function upload()
    {
        if ($this->validate()) {
            foreach ($this->imageFiles as $file) {
                $file->saveAs('img/' . $file->baseName . '.' . $file->extension);
            }
            return true;
        } else {
            return false;
        }
    }
}
