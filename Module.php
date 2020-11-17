<?php
/**
 */

namespace execut\menu;

use execut\dependencies\PluginBehavior;
use execut\menu\models\Item;
use yii\db\ActiveQuery;
use yii\i18n\PhpMessageSource;

class Module extends \yii\base\Module implements Plugin
{
    public $adminRole = '@';
    public $models = [];
    public function behaviors()
    {
        return [
            'plugin' => [
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

    public function applyItemsScopes(ActiveQuery $q) {
        return $this->getPluginsResults(__FUNCTION__, false, [$q]);
    }

    public function addPlugin(Plugin $plugin)
    {
        return $this->getBehavior('plugin')->addPlugins([$plugin]);
    }

    public function getItemImageUrl(Item $item)
    {
        foreach ($this->getPlugins() as $plugin) {
            if ($result = $plugin->getItemImageUrl($item)) {
                return $result;
            }
        }
    }
}
