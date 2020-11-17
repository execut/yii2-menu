<?php
/**
 */

namespace execut\menu;


use execut\menu\models\Item;
use yii\db\ActiveQuery;

interface Plugin
{
    public function getItemFieldsPlugins();

    public function getUrlByItem(Item $item);

    public function applyItemsScopes(ActiveQuery $q);

    public function getItemImageUrl(Item $item);
}