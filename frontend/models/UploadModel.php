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
}