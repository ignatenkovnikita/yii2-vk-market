<?php

namespace ignatenkovnikita\vkmarket\helpers;


use ignatenkovnikita\vkmarket\interfaces\Product;
use ignatenkovnikita\vkmarket\services\Vk;

class VkHelper
{

    public static function createOrUpdate(Product $product)
    {
        $vkService = new Vk();

        $id = $vkService->addOrEditProduct($product->vk_id,
            $product->getVkName(),
            $product->getVkDescription(),
            $product->getVkCategoryId(),
            $product->getVkPrice(),
            $product->getVkMainPhotoPath(),
            $product->getVkPhotosArrPath(),
            $product->getVkUrl(true),
            $product->getVkOldPrice(),
            $product->getVkDeleted());

        if (empty($product->vk_id)) {
            $product->vk_id = $id;
            $product->updateAttributes(['vk_id']);
        }
    }

}