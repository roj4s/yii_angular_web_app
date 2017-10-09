<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product`.
 */
class m171008_110729_create_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('Product', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->defaultValue("Unknown"),
            'description'  => $this->string(255)->defaultValue("Without description"),
            'department'     => $this->integer()->null(),
            'price' => $this->float()->null(),
            'count' => $this->integer()->null(),
            'color' => $this->string()->defaultValue(""),
            'supplier_name' => $this->string()->defaultValue(""),
            'short_description' => $this->string()->defaultValue(""),
            'long_description' => $this->string()->defaultValue("")
        ]);

        $this->addForeignKey(
            "fk_product_department",
            "Product",
            "department",
            "Department",
            "id",
            "CASCADE"
            );

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey("fk_product_department", "Product");
        $this->dropTable('Product');
    }
}
