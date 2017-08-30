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
use \execut\menu\models\base\Menu as BaseMenu;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "menu_menus".
 */
class Menu extends BaseMenu
{
    const MODEL_NAME = '{n,plural,=0{Menus} =1{Menu} other{Menus}}';
    use BehaviorStub, ModelsHelperTrait;

    protected static $defaultId = null;
    public static function getDefaultId() {
        if (self::$defaultId !== null) {
            return self::$defaultId;
        }

        self::$defaultId = self::find()->andWhere('is_default')->select('id')->createCommand()->queryScalar();
        if (self::$defaultId === null) {
            self::$defaultId = false;
        }

        return self::$defaultId;
    }

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                'fields' => [
                    'class' => Behavior::class,
                    'fields' => $this->getStandardFields(null, [
                        [
                            'class' => HasOneSelect2::class,
                            'required' => true,
                            'attribute' => 'menu_position_id',
                            'relation' => 'menuPosition',
                            'url' => [
                                '/menu/positions'
                            ],
                        ],
                        [
                            'class' => Boolean::class,
                            'attribute' => 'is_default',
                        ],
                    ]),
                ],
                [
                    'class' => TimestampBehavior::className(),
                    'createdAtAttribute' => 'created',
                    'updatedAtAttribute' => 'updated',
                    'value' => new Expression('NOW()'),
                ],
                # custom behaviors
            ]
        );
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'menu_position_id' => 'Position',
        ]); // TODO: Change the autogenerated stub
    }
}
