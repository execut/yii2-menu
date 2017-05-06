<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace execut\menu\models\base;

use Yii;

/**
 * This is the base-model class for table "menu_items".
 *
 * @property integer $id
 * @property string $created
 * @property string $updated
 * @property string $name
 * @property string $url
 * @property boolean $target_blank
 * @property boolean $visible
 * @property integer $pages_page_id
 * @property integer $menu_item_id
 * @property integer $menu_menu_id
 *
 * @property \execut\menu\models\Item $menuItem
 * @property \execut\menu\models\Item[] $items
 * @property \execut\menu\models\Menu $menuMenu
 * @property \execut\menu\models\PagesPage $pagesPage
 * @property string $aliasModel
 */
abstract class Item extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu_items';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created', 'updated'], 'safe'],
            [['name', 'menu_menu_id'], 'required'],
            [['target_blank', 'visible'], 'boolean'],
            [['pages_page_id', 'menu_item_id', 'menu_menu_id'], 'default', 'value' => null],
            [['pages_page_id', 'menu_item_id', 'menu_menu_id'], 'integer'],
            [['name', 'url'], 'string', 'max' => 255],
            [['menu_item_id'], 'exist', 'skipOnError' => true, 'targetClass' => \execut\menu\models\Item::className(), 'targetAttribute' => ['menu_item_id' => 'id']],
            [['menu_menu_id'], 'exist', 'skipOnError' => true, 'targetClass' => \execut\menu\models\Menu::className(), 'targetAttribute' => ['menu_menu_id' => 'id']],
            [['pages_page_id'], 'exist', 'skipOnError' => true, 'targetClass' => \execut\menu\models\PagesPage::className(), 'targetAttribute' => ['pages_page_id' => 'id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('execut/menu', 'ID'),
            'created' => Yii::t('execut/menu', 'Created'),
            'updated' => Yii::t('execut/menu', 'Updated'),
            'name' => Yii::t('execut/menu', 'Name'),
            'url' => Yii::t('execut/menu', 'Url'),
            'target_blank' => Yii::t('execut/menu', 'Target Blank'),
            'visible' => Yii::t('execut/menu', 'Visible'),
            'pages_page_id' => Yii::t('execut/menu', 'Pages Page ID'),
            'menu_item_id' => Yii::t('execut/menu', 'Menu Item ID'),
            'menu_menu_id' => Yii::t('execut/menu', 'Menu Menu ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenuItem()
    {
        return $this->hasOne(\execut\menu\models\Item::className(), ['id' => 'menu_item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(\execut\menu\models\Item::className(), ['menu_item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenuMenu()
    {
        return $this->hasOne(\execut\menu\models\Menu::className(), ['id' => 'menu_menu_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPagesPage()
    {
        return $this->hasOne(\execut\menu\models\PagesPage::className(), ['id' => 'pages_page_id']);
    }


    
    /**
     * @inheritdoc
     * @return \execut\menu\models\queries\ItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \execut\menu\models\queries\ItemQuery(get_called_class());
    }


}
