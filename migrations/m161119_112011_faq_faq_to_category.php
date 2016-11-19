<?php

use yii\db\Schema;
use yii\db\Migration;

class m161119_112011_faq_faq_to_category extends Migration
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
            '{{%faq_faq_to_category}}',
            [
                'id'=> $this->primaryKey(11),
                'faq_id'=> $this->integer(11)->notNull(),
                'category_id'=> $this->integer(11)->notNull(),
            ],$tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%faq_faq_to_category}}');
    }
}
