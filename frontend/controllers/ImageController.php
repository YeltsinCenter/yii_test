<?php

namespace frontend\controllers;

use yii\rest\ActiveController;

class ImageController extends ActiveController
{
    public $modelClass = 'frontend\models\UploadModel';

    public function actionShow($id='')
    {
        var_dump('test1'); die;
    }
}