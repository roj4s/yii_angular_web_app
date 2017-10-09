<?php

use yii\db\Migration;

/**
 * Handles the creation of table `productimage`.
 */
class m171008_112407_create_productimage_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('ProductImage', [
            'id' => $this->primaryKey(),
            'product' => $this->integer(),
            'image'=> $this->integer()
        ]);

        $this->addForeignKey(
            "fk_productimage_product",
            "ProductImage",
            "product",
            "Product",
            "id",
            "CASCADE"
        );

        $this->addForeignKey(
            "fk_productimage_image",
            "ProductImage",
            "image",
            "Image",
            "id",
            "CASCADE"
        );

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey("fk_productimage_product", "ProductImage");
        $this->dropForeignKey("fk_productimage_image", "ProductImage");

        $this->dropTable('ProductImage');
    }
}
