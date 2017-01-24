<?php

use yii\db\Schema;
use yii\db\Migration;

class m161118_112011_faq_faq extends Migration
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
            '{{%faq_faq}}',
            [
                'id'=> $this->primaryKey(11),
                'category_id'=> $this->integer(11)->null()->defaultValue(null),
                'title'=> $this->string(255)->notNull(),
                'text'=> $this->text()->notNull(),
            ],$tableOptions
        );
        $this->createIndex('category_id','{{%faq_faq}}','category_id',false);
    }

    public function safeDown()
    {
        $this->dropIndex('category_id', '{{%faq_faq}}');
        $this->dropTable('{{%faq_faq}}');
    }
}
