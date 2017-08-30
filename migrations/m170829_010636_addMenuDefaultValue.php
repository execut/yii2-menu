<?php

use execut\yii\migration\Migration;
use execut\yii\migration\Inverter;

class m170829_010636_addMenuDefaultValue extends Migration
{
    public function initInverter(Inverter $i)
    {
        $i->table('menu_menus')
            ->addColumn('is_default', $this->boolean()->defaultValue(false));
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
