<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\helpers\Inflector;

class UploadImageForm extends UploadModel
{
    public $files;
    public $title;
    public $upload_date_time;

    public function rules()
    {
        return [
            [['files'], 'required'],
            ['files', 'file', 'extensions' => ['png', 'jpg', 'gif', 'webp'], 'maxFiles' => 5],
            ['title', 'string'],
            ['upload_date_time', 'datetime'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'files' => 'Загружаемые картинки',
            'title' => 'Название файла',
            'upload_date_time' => 'Дата и время загрузки'
        ];
    }

}
