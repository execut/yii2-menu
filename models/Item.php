<?php

namespace execut\menu\models;

use execut\crudFields\Behavior;
use execut\crudFields\BehaviorStub;
use execut\crudFields\fields\HasOneSelect2;
use execut\crudFields\ModelsHelperTrait;
use yii\behaviors\TimestampBehavior;
use yii\caching\TagDependency;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "menu_items".
 */
class Item extends ActiveRecord
{
    const CACHE_TAG = 'menu_items';
    const MODEL_NAME = '{n,plural,=0{Items} =1{Item} other{Items}}';
    use BehaviorStub, ModelsHelperTrait;
//    public function init()
//    {
//        parent::init(); // TODO: Change the autogenerated stub
////        $this->visible = true;
//        $defaultId = Menu::getDefaultId();
//        if ($defaultId) {
//            $this->menu_menu_id = $defaultId;
//        }
//    }


    public function behaviors()
    {
        if (YII_ENV === 'unit_test') {
            $itemFieldsPlugins = [];
        } else {
            $itemFieldsPlugins = \yii::$app->getModule('menu')->getItemFieldsPlugins();
        }

        return ArrayHelper::merge(
            parent::behaviors(),
            [
                'fields' => [
                    'class' => Behavior::class,
                    'plugins' => $itemFieldsPlugins,
                    'fields' => $this->getStandardFields(null, [
                        [
                            'class' => HasOneSelect2::class,
                            'attribute' => 'menu_menu_id',
                            'relation' => 'menuMenu',
                            'required' => true,
                            'url' => [
                                '/menu/menus'
                            ],
                            'defaultValue' => Menu::getDefaultId(),
                        ],
                        [
                            'required' => true,
                            'attribute' => 'sort',
                        ],
                        [
                            'class' => HasOneSelect2::class,
                            'attribute' => 'menu_item_id',
                            'relation' => 'menuItem',
                            'url' => [
                                '/menu/items'
                            ],
                        ],
                        'link_url' => [
                            'attribute' => 'link_url',
                            'rules' => [
                                'checkUrl' => ['link_url', 'checkUrl']
                            ],
                        ]
                    ]),
                ],
                [
                    'class' => TimestampBehavior::class,
                    'createdAtAttribute' => 'created',
                    'updatedAtAttribute' => 'updated',
                    'value' => new Expression('NOW()'),
                ],
                # custom behaviors
            ]
        );
    }

    public function checkUrl() {
        $url = $this->link_url;
        if (strpos($url, '://') !== false) {
            if (preg_match('/^http[s]?:\/\/[a-z0-9]+\.[-a-z0-9\/]+$/', $url) === 0) {
                $this->addError('link_url', \yii::t('execut/menu', 'Wrong url address'));
                return false;
            }
        } else {
            if (preg_match('/^[-a-zA-Z0-9\/]+$/', $url) === 0) {
                $this->addError('link_url', \yii::t('execut/menu', 'Allowed only next chars: /-a-Z0-9'));
                return false;
            }
        }

        return true;
    }

    public static function getMenuItems($position) {
        $q = self::find()->isVisible()->orderBySort()->byPositionKey($position);
        \yii::$app->getModule('menu')->applyItemsScopes($q);
        $items = $q->all();

        $result = self::getItemItems($items);

        return $result;
    }

    public function getUrl() {
        if (YII_ENV === 'unit_test') {
            $plugins = [];
        } else {
            $plugins = \yii::$app->getModule('menu')->getPlugins();
        }

        foreach ($plugins as $plugin) {
            $url = $plugin->getUrlByItem($this);
            if ($url) {
                return $url;
            }
        }

        return $this->link_url;
    }

    public function getImageUrl()
    {
        if (YII_ENV === 'test_unit') {
            $plugins = [];
        } else {
            $plugins = \yii::$app->getModule('menu')->getPlugins();
        }

        foreach ($plugins as $plugin) {
            $url = $plugin->getItemImageUrl($this);
            if ($url) {
                return $url;
            }
        }
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
                    'sort' => $item->sort,
                    'imageUrl' => $item->getImageUrl(),
                ];
            }
        }

        if ($parentId !== null) {
            uasort($result, function ($a, $b) {
                return $a['sort'] > $b['sort'];
            });
        }

        return $result;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu_items';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenuItem()
    {
        return $this->hasOne(\execut\menu\models\Item::class, ['id' => 'menu_item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(\execut\menu\models\Item::class, ['menu_item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenuMenu()
    {
        return $this->hasOne(\execut\menu\models\Menu::class, ['id' => 'menu_menu_id']);
    }


    /**
     * @inheritdoc
     * @return \execut\menu\models\queries\ItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return (new \execut\menu\models\queries\ItemQuery(get_called_class()))->cache(0, new TagDependency(['tags' => self::CACHE_TAG]));
    }

    public function beforeSave($insert)
    {
        $this->invalidateCache();

        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public function beforeDelete()
    {
        $this->invalidateCache();

        return parent::beforeDelete(); // TODO: Change the autogenerated stub
    }

    protected function invalidateCache(): void
    {
        TagDependency::invalidate(\yii::$app->cache, [self::CACHE_TAG]);
    }
}
