<?php

use yii\db\Migration;

/**
 * Class m240313_204922_images_table
 */
class m240313_204922_images_table extends Migration
{
    public function up()
    {
        date_default_timezone_set('Europe/Moscow');

        $this->createTable('images_table', [
            'id' => $this->primaryKey(),
            'title' => $this->string(50)->notNull(),
            'upload_date_time' => $this->string(20)->defaultValue(date('d-m-Y H:i:s')),
        ]);
    }

    public function down()
    {
        $this->dropTable('news');
    }
}
