<?php

use yii\db\Schema;
use yii\db\Migration;

class m180509_082139_goods extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%goods}}',
            [
                'id_goods'=> $this->primaryKey(11),
                'id_category'=> $this->integer(11)->null()->defaultValue(null),
                'id_brand'=> $this->integer(11)->null()->defaultValue(null),
                'name'=> $this->string(250)->null()->defaultValue(null),
                'code'=> $this->integer(11)->null()->defaultValue(null),
                'price'=> $this->decimal(10, 2)->null()->defaultValue(null),
                'color'=> $this->char(12)->null()->defaultValue(null),
                'width'=> $this->float()->null()->defaultValue(null),
                'height'=> $this->float()->null()->defaultValue(null),
                'lenght'=> $this->float()->null()->defaultValue(null),
            ],$tableOptions
        );
        $this->createIndex('FK_goods_category','{{%goods}}',['id_category'],false);
        $this->createIndex('FK_goods_brand','{{%goods}}',['id_brand'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('FK_goods_category', '{{%goods}}');
        $this->dropIndex('FK_goods_brand', '{{%goods}}');
        $this->dropTable('{{%goods}}');
    }
}
