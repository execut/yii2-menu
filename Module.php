<?php
/**
 */

namespace execut\menu;

use execut\dependencies\PluginBehavior;
use execut\menu\models\Item;
use yii\i18n\PhpMessageSource;

class Module extends \yii\base\Module implements Plugin
{
    public $models = [];
    public function behaviors()
    {
        return [
            [
                'class' => PluginBehavior::class,
                'pluginInterface' => Plugin::class,
            ],
        ];
    }

    public $defaultRoute = 'menus';

    public function getItemFieldsPlugins() {
        $result = [];
        foreach ($this->getPlugins() as $plugin) {
            $result = array_merge($result, $plugin->getItemFieldsPlugins());
        }

        return $result;
    }

    public function getModels() {
        return array_merge($this->getPluginsResults(__FUNCTION__), $this->models);
    }

    public function getUrlByItem(Item $item)
    {
        foreach ($this->getPlugins() as $plugin) {
            if ($result = $plugin->getUrlByItem($item)) {
                return $result;
            }
        }
    }
}