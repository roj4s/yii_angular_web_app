<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ProductImage".
 *
 * @property integer $image
 * @property integer $product
 * @property integer $id
 *
 * @property Image $image0
 * @property Product $product0
 */
class ProductImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ProductImage';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image', 'product'], 'required'],
            [['image', 'product', 'id'], 'integer'],
            [['image'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['image' => 'id']],
            [['product'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'image' => 'Image',
            'product' => 'Product',
            'id' => 'ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage0()
    {
        return $this->hasOne(Image::className(), ['id' => 'image']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct0()
    {
        return $this->hasOne(Product::className(), ['id' => 'product']);
    }
}
