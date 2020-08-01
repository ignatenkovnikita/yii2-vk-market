<?php

use yii\db\Migration;

/**
 * Class m200730_211712_add_table_album
 */
class m200730_211712_add_table_album extends Migration
{

    const TABLE_ALBUM = '{{%vkmarket_album}}';
    const TABLE_ALBUM_PRODUCT = '{{%vkmarket_album_product}}';

    use \ignatenkovnikita\migrationsaddons\ForeignKeyTrait;
    use \ignatenkovnikita\migrationsaddons\AddCreatedUpdated;
    use \ignatenkovnikita\migrationsaddons\AddAuthorUpdater;

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        /** @var \yii\db\ActiveRecord $modelProduct */
        $modelProduct = Yii::createObject(Yii::$app->getModule('vkmarket')->product);

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable(self::TABLE_ALBUM, [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'main_album' => $this->boolean()->defaultValue(false),
            'vk_id' => $this->integer()

        ],$tableOptions);
        $this->addAllTime(self::TABLE_ALBUM);
        $this->addAllUser(self::TABLE_ALBUM);


        $this->addColumn($modelProduct::tableName(),'vk_id', $this->integer());
        $this->addColumn($modelProduct::tableName(),'export_vk', $this->boolean()->defaultValue(false));

        $this->createTable(self::TABLE_ALBUM_PRODUCT,[
            'id' => $this->primaryKey(),
            'album_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull()
        ]);
        $this->addForeignKeys(self::TABLE_ALBUM_PRODUCT,[
            ['album_id', self::TABLE_ALBUM,'id'],
            ['product_id', $modelProduct::tableName(),'id'],
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_ALBUM);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200730_211712_add_table_album cannot be reverted.\n";

        return false;
    }
    */
}
