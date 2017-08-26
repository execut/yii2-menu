<?php

namespace execut\menu\models;

use execut\crudFields\Behavior;
use execut\crudFields\BehaviorStub;
use execut\crudFields\fields\Action;
use execut\crudFields\fields\Boolean;
use execut\crudFields\fields\Date;
use execut\crudFields\fields\Id;
use execut\crudFields\ModelsHelperTrait;
use \execut\menu\models\base\Position as BasePosition;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "menu_positions".
 */
class Position extends BasePosition
{
    use BehaviorStub, ModelsHelperTrait;
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
                            'attribute' => 'key',
                        ],
                        [
                            'required' => true,
                            'attribute' => 'name',
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
