<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 08.02.2016
 * Time: 19:52
 */

namespace app\controllers;

use yii\web\Controller;

/**
 * GalleryController implements the CRUD actions for Gallery model.
 */
class GalleryController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
} 
