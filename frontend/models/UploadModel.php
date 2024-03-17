<?php

namespace frontend\models;

use yii\db\ActiveRecord;
use yii\helpers\Inflector;

class UploadModel extends ActiveRecord
{
    /**
     * @return string название таблицы, сопоставленной с этим ActiveRecord-классом.
     */
    public static function tableName()
    {
        return '{{images_table}}';
    }

    public function upload()
    {
        if ($this->validate()) {
            foreach ($this->files as $file) {
                $path = \Yii::getAlias('@frontend') . '/web/uploads/';
                $baseName = strtolower(Inflector::transliterate($file->baseName));

                if (in_array($baseName . '.' . $file->extension, scandir($path))) {
                    $baseName = strtolower(\Yii::$app->security->generateRandomString(12));
                }
                $file->saveAs($path . $baseName . '.' . $file->extension);
                $this->saveInDb($baseName . '.' . $file->extension);
            }
            return true;
        } else {
            return false;
        }
    }

    public function saveInDb($file_name)
    {
        $model = new UploadModel();
        $model->setAttribute('title', $file_name);
        $model->setAttribute('upload_date_time', date('d-m-Y H:i:s'));
        $model->save();
    }

    public static function showImages()
    {
        $images = self::find()->asArray()->all();

        return $images;
    }

    public function uploadAsArchive($filename)
    {
        $path = \Yii::getAlias('@frontend') . '/web';
        if (file_exists($path . $filename)) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime  = finfo_file($finfo, $path . $filename);
            finfo_close($finfo);
            $size  = filesize($path . $filename);

            header("Content-Type: ".$mime);
            header("Content-Length: ".$size);
            header("Content-Disposition: attachment; filename=\"" . $filename . "\"");
            readfile($path . $filename);
        } else {
            throw new CHttpException(404, 'Файл не найден');
        }
    }
}