<?php

namespace execut\menu\models\queries;
use execut\menu\models;

/**
 * This is the ActiveQuery class for [[\execut\menu\models\Item]].
 *
 * @see \execut\menu\models\Item
 */
class ItemQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \execut\menu\models\Item[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \execut\menu\models\Item|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function byPositionKey($position) {
        $menu = models\Menu::find()->byPositionKey($position)->select('id');

        return $this->andWhere([
            'menu_menu_id' => $menu,
            'visible' => true,
        ]);
    }
}
