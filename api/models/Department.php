<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Department".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $icon_class
 *
 * @property Product[] $products
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Department';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['icon_class'], 'required'],
            [['icon_class'], 'integer'],
            [['name', 'description'], 'string', 'max' => 255],
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
            'icon_class' => 'Icon Class',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['department' => 'id']);
    }
}
