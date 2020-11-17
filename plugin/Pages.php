<?php
/**
 */

namespace execut\menu\plugin;


use execut\menu\models\Item;
use execut\menu\Plugin;
use execut\pages\models\Page;
use yii\base\Module;
use yii\db\ActiveQuery;

class Pages implements Plugin
{
    public function getItemFieldsPlugins() {
        return [
            [
                'class' => \execut\pages\crudFields\Plugin::class,
            ],
        ];
    }

    public function getUrlByItem(Item $item)
    {
        if (!empty($item->pages_page_id)) {
            return [
                '/pages/frontend/index',
                'alias' => $item->pagesPage->alias,
            ];
        }
    }

    public function applyItemsScopes(ActiveQuery $q) {
        return $q->with([
            'pagesPage' => function ($q) {
                $q->forLinks();
            }
        ]);
    }

    public function getModels() {
        return [
            Page::class,
        ];
    }

    public function getItemImageUrl(Item $item)
    {
    }
}