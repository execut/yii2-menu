<?php
/**
 */

namespace execut\menu;


use execut\menu\models\Item;

interface Plugin
{
    public function getItemFieldsPlugins();

    public function getUrlByItem(Item $item);

    public function getModels();
}