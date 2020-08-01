<?php

namespace ignatenkovnikita\vkmarket;

/**
 * yii2-vk-market module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'ignatenkovnikita\vkmarket\controllers';

    public $product;

    public $accessToken;

    public $groupId;    
    
    public $ownerId;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }


    public static function backendControllerNamespace()
    {
        $class = new \ReflectionClass(static::class);
        return $class->getNamespaceName() . '\\backend\\controllers';
    }
}
