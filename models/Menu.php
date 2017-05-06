<?php

namespace execut\menu\models;

use execut\crudFields\Behavior;
use execut\crudFields\BehaviorStub;
use execut\crudFields\fields\Action;
use execut\crudFields\fields\Boolean;
use execut\crudFields\fields\Date;
use execut\crudFields\fields\HasOneSelect2;
use execut\crudFields\fields\Id;
use Yii;
use \execut\menu\models\base\Menu as BaseMenu;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "menu_menus".
 */
class Menu extends BaseMenu
{
    use BehaviorStub;
    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                'fields' => [
                    'class' => Behavior::class,
                    'fields' => [
                        [
                            'class' => Id::class,
                            'attribute' => 'id',
                        ],
                        [
                            'required' => true,
                            'attribute' => 'name',
                        ],
                        [
                            'class' => HasOneSelect2::class,
                            'required' => true,
                            'attribute' => 'menu_position_id',
                            'url' => [
                                '/menu/positions'
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
}
