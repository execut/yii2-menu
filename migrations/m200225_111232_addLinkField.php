<?php
namespace execut\menu\migrations;

use execut\yii\migration\Migration;
use execut\yii\migration\Inverter;

class m200225_111232_addLinkField extends Migration
{
    public function initInverter(Inverter $i)
    {
        $i->table('menu_items')
            ->addColumn('link_url', $this->string(2048));
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
