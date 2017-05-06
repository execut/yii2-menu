<?php
/**
 */

namespace execut\menu;


use execut\menu\models\Item;

class Component extends \yii\base\Component
{
    public $menuItemsModel = Item::class;
    public function getMenuItems($position) {
        $modelClass = $this->menuItemsModel;

        return $modelClass::getMenuItems($position);
    }
}