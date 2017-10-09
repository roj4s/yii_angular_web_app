<?php

use yii\db\Migration;

/**
 * Handles the creation of table `image`.
 */
class m171008_112208_create_image_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('Image', [
            'id' => $this->primaryKey(),
            'url' => $this->string(255),
            'description'  => $this->string(255),
            'thumbnail_url'  => $this->string(255),
            'medium_url'  => $this->string(255),
            'large_url'  => $this->string(255),
        ]);

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('Image');
    }
}
