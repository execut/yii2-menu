<?php

use execut\yii\migration\Migration;
use execut\yii\migration\Inverter;

class m170402_192559_initalStructure extends Migration
{
    public function initInverter(Inverter $i)
    {
        $menus = $i->table('menu_menus')->create($this->defaultColumns([
            'name' => $this->string()->notNull(),
            'visible' => $this->boolean()->notNull()->defaultValue(true)
        ]));
        $positions = $i->table('menu_positions')->create($this->defaultColumns([
            'name' => $this->string()->notNull(),
            'key' => $this->string()->notNull(),
            'visible' => $this->boolean()->notNull()->defaultValue(true)
        ]))->createIndex('key', true);
        $menus->addForeignColumn($positions->name, true)
            ->createIndex('menu_position_id');

        $items = $i->table('menu_items')->create($this->defaultColumns([
            'name' => $this->string()->notNull(),
            'url' => $this->string(),
            'target_blank' => $this->boolean()->defaultValue('false'),
            'visible' => $this->boolean()->notNull()->defaultValue(true)
        ]))
            ->addForeignColumn('menu_items')
            ->createIndex('menu_item_id')
            ->addForeignColumn($menus->name, true)
            ->createIndex('menu_menu_id');
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
