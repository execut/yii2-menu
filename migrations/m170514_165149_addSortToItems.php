<?php
namespace execut\menu\migrations;

use execut\yii\migration\Migration;
use execut\yii\migration\Inverter;

class m170514_165149_addSortToItems extends Migration
{
    public function initInverter(Inverter $i)
    {
        $i->table('menu_items')->addColumn('sort', $this->integer()->notNull())
            ->alterColumnSetDefault('sort', 0);
    }
}
