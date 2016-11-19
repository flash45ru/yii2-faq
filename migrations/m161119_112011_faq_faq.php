<?php

use yii\db\Schema;
use yii\db\Migration;

class m161119_112011_faq_faq extends Migration
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
                'faq_id'=> $this->primaryKey(11),
                'faq_category_id'=> $this->integer(11)->null()->defaultValue(null),
                'faq_title'=> $this->string(255)->notNull(),
                'faq_text'=> $this->text()->notNull(),
            ],$tableOptions
        );
        $this->createIndex('faq_category_id','{{%faq_faq}}','faq_category_id',false);
    }

    public function safeDown()
    {
        $this->dropIndex('faq_category_id', '{{%faq_faq}}');
        $this->dropTable('{{%faq_faq}}');
    }
}
