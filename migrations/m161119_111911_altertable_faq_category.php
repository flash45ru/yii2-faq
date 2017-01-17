<?php

use yii\db\Schema;
use yii\db\Migration;

class m161119_111911_altertable_faq_category extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {

        $this->addColumn('{{%faq_category}}','sort',$this->integer(1)->null());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%faq_category}}', 'sort');
    }
}
