<?php

use yii\db\Schema;
use yii\db\Migration;

class m180508_174533_user extends Migration
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
            '{{%user}}',
            [
                'id'=> $this->primaryKey(11),
                'created_at'=> $this->integer(11)->notNull(),
                'updated_at'=> $this->integer(11)->notNull(),
                'username'=> $this->string(255)->notNull(),
                'auth_key'=> $this->string(32)->null()->defaultValue(null),
                'email_confirm_token'=> $this->string(255)->null()->defaultValue(null),
                'password_hash'=> $this->string(255)->notNull(),
                'password_reset_token'=> $this->string(255)->null()->defaultValue(null),
                'email'=> $this->string(255)->notNull(),
                'status'=> $this->smallInteger(6)->notNull()->defaultValue(0),
            ],$tableOptions
        );
        $this->createIndex('idx-user-username','{{%user}}',['username'],false);
        $this->createIndex('idx-user-email','{{%user}}',['email'],false);
        $this->createIndex('idx-user-status','{{%user}}',['status'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('idx-user-username', '{{%user}}');
        $this->dropIndex('idx-user-email', '{{%user}}');
        $this->dropIndex('idx-user-status', '{{%user}}');
        $this->dropTable('{{%user}}');
    }
}
