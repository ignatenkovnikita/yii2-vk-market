<?php

namespace ignatenkovnikita\vkmarket\query;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[\common\models\generated\models\VkmarketAlbumProduct]].
 *
 * @see \common\models\generated\models\VkmarketAlbumProduct
 */
class VkmarketAlbumProductQuery extends ActiveQuery
{
    /*public function active()
    {
    return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ignatenkovnikita\vkmarket\models\VkmarketAlbumProduct[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ignatenkovnikita\vkmarket\models\VkmarketAlbumProduct|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
