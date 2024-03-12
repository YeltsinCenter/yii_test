<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

class UploadImageForm extends Model
{
    public $files;
    public $file_name;
    public $date_time;

    public function rules()
    {
        return [
            [['files', 'file_name', 'date_time'], 'required'],
            ['files', 'file', 'extensions' => ['png', 'jpg', 'gif', 'webp'], 'maxFiles' => 5],
            ['file_name', 'string'],
            ['date_time', 'datetime'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'files' => 'Загружаемые картинки',
            'file_name' => 'Название файла',
            'date_time' => 'Дата и время загрузки'
        ];
    }

}
