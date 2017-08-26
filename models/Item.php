<?php

namespace execut\menu\models;

use execut\crudFields\Behavior;
use execut\crudFields\BehaviorStub;
use execut\crudFields\fields\Action;
use execut\crudFields\fields\Boolean;
use execut\crudFields\fields\Date;
use execut\crudFields\fields\HasOneSelect2;
use execut\crudFields\fields\Id;
use execut\crudFields\ModelsHelperTrait;
use Yii;
use \execut\menu\models\base\Item as BaseItem;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "menu_items".
 */
class Item extends BaseItem
{
    use BehaviorStub, ModelsHelperTrait;
    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                'fields' => [
                    'class' => Behavior::class,
                    'plugins' => \yii::$app->getModule('menu')->getItemFieldsPlugins(),
                    'fields' => [
                        [
                            'class' => Id::class,
                            'attribute' => 'id',
                        ],
                        [
                            'class' => HasOneSelect2::class,
                            'attribute' => 'menu_menu_id',
                            'url' => [
                                '/menu/menus'
                            ],
                        ],
                        [
                            'required' => true,
                            'attribute' => 'name',
                        ],
                        [
                            'required' => true,
                            'attribute' => 'sort',
                        ],
                        [
                            'class' => HasOneSelect2::class,
                            'attribute' => 'menu_item_id',
                            'url' => [
                                '/menu/items'
                            ],
                        ],
                        [
                            'class' => Boolean::class,
                            'attribute' => 'visible',
                        ],
                        [
                            'class' => Date::class,
                            'attribute' => 'created',
                        ],
                        [
                            'class' => Date::class,
                            'attribute' => 'updated',
                        ],
                        [
                            'class' => Action::class,
                        ],
                    ],
                ],
                # custom behaviors
            ]
        );
    }

    public static function getMenuItems($position) {
        $items = self::find()->isVisible()->orderBySort()->byPositionKey($position)->all();

        $result = self::getItemItems($items);

        return $result;
    }

    public function getUrl() {
        $plugins = \yii::$app->getModule('menu')->getPlugins();
        foreach ($plugins as $plugin) {
            $url = $plugin->getUrlByItem($this);
            if ($url) {
                return $url;
            }
        }

        return [];
    }

    public static function getItemItems(&$items, $parentId = null) {
        $result = [];
        foreach ($items as $key => $item) {
            if ($item->menu_item_id === $parentId) {
                unset($items[$key]);
                $result[] = [
                    'label' => $item->name,
                    'url' => $item->getUrl(),
                    'items' => self::getItemItems($items, $item->id),
                ];
            }
        }

        return $result;
    }
}
