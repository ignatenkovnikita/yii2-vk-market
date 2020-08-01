<?php

namespace ignatenkovnikita\vkmarket\query;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[\common\models\generated\models\VkmarketAlbum]].
 *
 * @see \common\models\generated\models\VkmarketAlbum
 */
class VkmarketAlbumQuery extends ActiveQuery
{
    /*public function active()
    {
    return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \ignatenkovnikita\vkmarket\models\VkmarketAlbum[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \ignatenkovnikita\vkmarket\models\VkmarketAlbum|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
