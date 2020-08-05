<?php

namespace ignatenkovnikita\vkmarket\services;


use Asil\VkMarket\Model\Album;
use Asil\VkMarket\Model\Photo;
use Asil\VkMarket\Model\Product;
use Asil\VkMarket\VkConnect;
use Asil\VkMarket\VkServiceDispatcher;

class Vk
{
    /** @var VkServiceDispatcher $vkService */
    private $vkService;

    public function __construct()
    {
        $module = \Yii::$app->getModule('vkmarket');
        $accessToken = $module->accessToken;
        $ownerId = $module->ownerId; // идентификатор владельца группы
        $groupId = $module->groupId; // идентификатор группы

        $connect = new VkConnect($accessToken, $groupId, $ownerId);
        $this->vkService = new VkServiceDispatcher($connect);

    }

    public function addAlbum($title, $main_album, $path)
    {

        $album = new Album($title, '', $main_album);

        $photo = new Photo();
        $photo->createAlbumPhoto($path);

        $response = $this->vkService->addAlbum($album, $photo);

        return $response['market_album_id'];

    }

    public function editAlbum($id, $title, $main_album, $path)
    {

        $album = new Album($title, '', $main_album);

        $photo = new Photo();
        $photo->createAlbumPhoto($path);

        $response = $this->vkService->editAlbum($id, $album, $photo);

        return $response['market_album_id'];

    }


    public function deleteAlbum($id)
    {
        return $this->vkService->deleteAlbum($id);

    }

    public function addProductToAlbum($albumId, $vkItemId)
    {
        return $this->vkService->addProductToAlbum([$albumId], $vkItemId);
    }

    public function removeFromAlbum($albumId, $vkItemId)
    {
        return $this->vkService->removeFromAlbum([$albumId], $vkItemId);
    }


    public function addOrEditProduct($id = null,
                                     $title,
                                     $description,
                                     $categoryId,
                                     $price,
                                     $mainPath,
                                     $additionalArray = [],
                                     $url = null,
                                     $oldPrice)
    {
        $product = new Product($title, $description, $categoryId, $price);
        $product->setUrl($url);
        $product->setOldPrice($oldPrice);
        $product->setVkItemId($id);
        $photo = new Photo();

        $photo->createMainPhoto($mainPath);
        if (!empty($additionalArray)) {
            $photo->createAdditionalPhoto($additionalArray);
        }

        if ($id) {
            return $this->vkService->editProduct($product, $photo);
        } else {
            return $this->vkService->addProduct($product, $photo);
        }
    }

    public function getCategories($count, $offset = '')
    {
        return $this->vkService->getCategories($count, $offset = '');
    }
}