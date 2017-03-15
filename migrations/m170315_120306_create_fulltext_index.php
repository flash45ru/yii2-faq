<?php

use yii\db\Migration;

class m170315_120306_create_fulltext_index extends Migration
{
    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->execute("ALTER TABLE `faq_faq` ADD FULLTEXT `search_index` (`title`, `text`);");
    }

    public function safeDown()
    {
        $this->execute("ALTER TABLE `faq_faq` DROP INDEX `search_index`");
    }

}
