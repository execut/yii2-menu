<?php

namespace execut\menu\models;

use execut\crudFields\Behavior;
use execut\crudFields\BehaviorStub;
use execut\crudFields\fields\Boolean;
use execut\crudFields\fields\HasOneSelect2;
use execut\crudFields\ModelsHelperTrait;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "menu_menus".
 */
class Menu extends ActiveRecord
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

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu_menus';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(\execut\menu\models\Item::className(), ['menu_menu_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenuPosition()
    {
        return $this->hasOne(\execut\menu\models\Position::className(), ['id' => 'menu_position_id']);
    }



    /**
     * @inheritdoc
     * @return \execut\menu\models\queries\MenuQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \execut\menu\models\queries\MenuQuery(get_called_class());
    }
}
