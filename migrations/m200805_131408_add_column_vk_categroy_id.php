<?php

use yii\db\Migration;

/**
 * Class m200805_131408_add_column_vk_categroy_id
 */
class m200805_131408_add_column_vk_categroy_id extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        /** @var \yii\db\ActiveRecord $modelProduct */
        $modelProduct = Yii::createObject(Yii::$app->getModule('vkmarket')->product);

        $this->addColumn($modelProduct::tableName(),'vk_category_id', $this->integer());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200805_131408_add_column_vk_categroy_id cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200805_131408_add_column_vk_categroy_id cannot be reverted.\n";

        return false;
    }
    */
}
