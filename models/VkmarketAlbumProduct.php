<?php

namespace ignatenkovnikita\vkmarket\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "vkmarket_album_product".
 *
 * @property integer $id ID
 * @property integer $album_id Album ID
 * @property integer $product_id Product ID
 *
     * @property VkmarketAlbum $album
     * @property ShopProduct $product
    */
class VkmarketAlbumProduct extends ActiveRecord
{

            
    /**
    * @inheritdoc
    */
    public static function tableName()
    {
        return 'vkmarket_album_product';
    }

    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            [['album_id', 'product_id'], 'required'],
            [['album_id', 'product_id'], 'integer'],
            [['album_id'], 'exist', 'skipOnError' => true, 'targetClass' => VkmarketAlbum::className(), 'targetAttribute' => ['album_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Yii::$app->getModule('vkmarket')->product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
    * @inheritdoc
    */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'album_id' => 'Album ID',
            'product_id' => 'Product ID',
            ];
    }

        /**
     * @return \yii\db\ActiveQuery
     * @throws \Exception
    */
    public function getAlbum()
    {
        return $this->hasOne('VkmarketAlbum', ['id' => 'album_id']);
    }

        /**
     * @return \yii\db\ActiveQuery
     * @throws \Exception
    */
    public function getProduct()
    {
        return $this->hasOne(Yii::$app->getModule('vkmarket')->product, ['id' => 'product_id']);
    }
    
    /**
     * @inheritdoc
     * @return \common\models\query\VkmarketAlbumProductQuery the active query used by this AR class.
    */
    public static function find()
    {
        return new  \ignatenkovnikita\vkmarket\query\VkmarketAlbumProductQuery(get_called_class());
    }
}
