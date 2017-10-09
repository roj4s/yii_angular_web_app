<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Product".
 *
 * @property integer $id
 * @property integer $name
 * @property integer $description
 * @property integer $department
 * @property double $price
 * @property integer $count
 * @property string $color
 * @property string $supplier_name
 * @property string $short_description
 * @property string $long_description
 *
 * @property Department $department0
 * @property ProductImage[] $productImages
 */
class Product extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['department', 'count'], 'integer'],
            [['price'], 'number'],
            [['name', 'description','color', 'supplier_name', 'short_description', 'long_description'], 'string', 'max' => 255],
            [['department'], 'exist', 'skipOnError' => false, 'targetClass' => Department::className(), 'targetAttribute' => ['department' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'department' => 'Department',
            'price' => 'Price',
            'count' => 'Count',
            'color' => 'Color',
            'supplier_name' => 'Supplier Name',
            'short_description' => 'Short Description',
            'long_description' => 'Long Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment0()
    {
        return $this->hasOne(Department::className(), ['id' => 'department']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductImages()
    {
        return $this->hasMany(ProductImage::className(), ['product' => 'id']);
    }

    /* @return array */
    public function extraFields()
    {
        return [
            'department'
        ];
    }

}
