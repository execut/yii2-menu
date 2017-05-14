<?php
/**
 */

namespace execut\menu;


use execut\yii\migration\Table;

class MigrationHelper
{
    /**
     * @var Table
     */
    public $table = null;
    public $moduleTable = null;
    public function attach() {
        $this->table
            ->addForeignColumn($this->moduleTable)
            ->createIndex($this->table->getColumnNameFromTable($this->moduleTable));
    }
}