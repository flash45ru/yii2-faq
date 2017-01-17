<?php

use yii\db\Schema;
use yii\db\Migration;

class m161119_112011_altertable_faq_faq extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->addColumn('{{%faq_faq}}','sort',$this->integer(1)->null());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%faq_faq}}','sort');
    }
}
