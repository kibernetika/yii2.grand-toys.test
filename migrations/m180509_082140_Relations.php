<?php

use yii\db\Schema;
use yii\db\Migration;

class m180509_082140_Relations extends Migration
{

    public function init()
    {
       $this->db = 'db';
       parent::init();
    }

    public function safeUp()
    {
        $this->addForeignKey('fk_goods_id_brand',
            '{{%goods}}','id_brand',
            '{{%brand}}','id_brand',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_goods_id_category',
            '{{%goods}}','id_category',
            '{{%category}}','id_category',
            'CASCADE','CASCADE'
         );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_goods_id_brand', '{{%goods}}');
        $this->dropForeignKey('fk_goods_id_category', '{{%goods}}');
    }
}
