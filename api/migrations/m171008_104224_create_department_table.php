<?php

use yii\db\Migration;

/**
 * Handles the creation of table `department`.
 */
class m171008_104224_create_department_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('Department', [
            'id'        => $this->primaryKey(),
            'name' => $this->string(255),
            'description'  => $this->string(255),
            'icon_class'     => $this->string(100),
        ]);


    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('Department');
    }
}
