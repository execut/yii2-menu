<?php

class m170514_141532_attachToModules extends \execut\yii\migration\Migration
{
    public function initInverter(\execut\yii\migration\Inverter $i)
    {
        $helper = new \execut\menu\MigrationHelper();
        $module = \yii::$app->getModule('menu');
        foreach ($module->getModels() as $model) {
            $helper->table = $i->table('menu_items');
            $helper->moduleTable = $model::tableName();
            $helper->attach();
        }
    }
}
