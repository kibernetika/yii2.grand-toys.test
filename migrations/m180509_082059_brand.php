<?php

use yii\db\Schema;
use yii\db\Migration;

class m180509_082059_brand extends Migration
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
            '{{%brand}}',
            [
                'id_brand'=> $this->primaryKey(11),
                'name'=> $this->char(50)->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%brand}}');
    }
}
