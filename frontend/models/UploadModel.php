<?php

namespace frontend\models;

use yii\db\ActiveRecord;

class UploadModel extends ActiveRecord
{
    /**
     * @return string название таблицы, сопоставленной с этим ActiveRecord-классом.
     */
    public static function tableName()
    {
        return '{{images_table}}';
    }
}