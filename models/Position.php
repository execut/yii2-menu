<?php

namespace execut\menu\models;

use execut\crudFields\Behavior;
use execut\crudFields\BehaviorStub;
use execut\crudFields\fields\Action;
use execut\crudFields\fields\Boolean;
use execut\crudFields\fields\Date;
use execut\crudFields\fields\Id;
use execut\crudFields\ModelsHelperTrait;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "menu_positions".
 */
class Position extends ActiveRecord
{
    const MODEL_NAME = '{n,plural,=0{Positions} =1{Position} other{Positions}}';
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
                            'isTime' => true,
                        ],
                        [
                            'class' => Date::class,
                            'attribute' => 'updated',
                            'isTime' => true,
                        ],
                        [
                            'class' => Action::class,
                        ],
                    ],
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

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu_positions';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenus()
    {
        return $this->hasMany(\execut\menu\models\Menu::class, ['menu_position_id' => 'id']);
    }



    /**
     * @inheritdoc
     * @return \execut\menu\models\queries\PositionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \execut\menu\models\queries\PositionQuery(get_called_class());
    }
}
