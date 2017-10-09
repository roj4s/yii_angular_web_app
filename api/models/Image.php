<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Image".
 *
 * @property integer $id
 * @property string $url
 * @property string $description
 * @property string $thumbnail_url
 * @property string $tag
 * @property string $medium_url
 * @property string $large_url
 *
 * @property ProductImage[] $productImages
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url', 'description', 'thumbnail_url', 'tag', 'medium_url', 'large_url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'description' => 'Description',
            'thumbnail_url' => 'Thumbnail Url',
            'tag' => 'Tag',
            'medium_url' => 'Medium Url',
            'large_url' => 'Large Url',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductImages()
    {
        return $this->hasMany(ProductImage::className(), ['image' => 'id']);
    }
}
