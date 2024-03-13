<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\helpers\Inflector;

class UploadImageForm extends UploadModel
{
    public $files;
    public $file_name;
    public $date_time;

    public function rules()
    {
        return [
            [['files'], 'required'],
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

    public function upload()
    {
        if ($this->validate()) {
            foreach ($this->files as $file) {
                $path = Yii::getAlias('@frontend') . '/web/uploads/';
                $baseName = strtolower(Inflector::transliterate($file->baseName));

                if (in_array($baseName . '.' . $file->extension, scandir($path))) {
                    $baseName = strtolower(Yii::$app->security->generateRandomString(12));
                }
                $file->saveAs($path . $baseName . '.' . $file->extension);
                $this->saveInDb($baseName . '.' . $file->extension);
            }
            return true;
        } else {
            return false;
        }
    }

    public function saveInDb($file_name) {
        $model = new UploadModel();
        $model->setAttribute('title', $file_name);
        $model->setAttribute('upload_date_time', date('d-m-Y H:i:s'));
        $model->save();
    }

}
