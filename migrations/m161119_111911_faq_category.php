<?php

use yii\db\Schema;
use yii\db\Migration;

class m161119_111911_faq_category extends Migration
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
            '{{%faq_category}}',
            [
                'id'=> $this->primaryKey(11),
                'parent_id'=> $this->integer(11)->null()->defaultValue(null),
                'name'=> $this->string(255)->notNull(),
            ],$tableOptions
        );
        $this->createIndex('id','{{%faq_category}}','id,parent_id',false);
    }

    public function safeDown()
    {
        $this->dropIndex('id', '{{%faq_category}}');
        $this->dropTable('{{%faq_category}}');
    }
}
