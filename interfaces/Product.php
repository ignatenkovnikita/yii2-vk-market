<?php
namespace ignatenkovnikita\vkmarket\interfaces;


interface Product
{
    
    public function getTitleForVkMarketSelect();
    
    public function getVkId();
    public function getVkName();
    public function getVkDescription();
    public function getVkCategoryId();
    public function getVkPrice();
    public function getVkMainPhotoPath();
    public function getVkPhotosArrPath();
    public function getVkUrl();
    public function getVkOldPrice();
    public function getVkDeleted();
    public function isValidExportVk();

}