# Vk Market


Add to config
```php
'vkmarket' => [
            'class' => 'ignatenkovnikita\vkmarket\Module',
            'controllerNamespace' => \ignatenkovnikita\vkmarket\Module::backendControllerNamespace(),
            'viewPath' => '@vendor/ignatenkovnikita/yii2-vk-market/backend/views',
            'product' => you_class_product,
            'accessToken' => your_access_token,
            'groupId' => youar_group_id,
            'ownerId' => youar_owner_id
        ],
```

Run Migration
```bash
 ./console/yii migrate --migrationPath=vendor/ignatenkovnikita/yii2-vk-market/migrations/
```


Implements interface Product