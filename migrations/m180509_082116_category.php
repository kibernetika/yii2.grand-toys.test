<?php

use yii\db\Schema;
use yii\db\Migration;

class m180509_082116_category extends Migration
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
            '{{%category}}',
            [
                'id_category'=> $this->primaryKey(11),
                'name'=> $this->char(250)->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%category}}');
    }
}
