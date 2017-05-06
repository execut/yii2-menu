<?php

namespace execut\menu\models\queries;
use execut\menu\models;

/**
 * This is the ActiveQuery class for [[\execut\menu\models\Menu]].
 *
 * @see \execut\menu\models\Menu
 */
class MenuQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \execut\menu\models\Menu[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \execut\menu\models\Menu|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function byPositionKey($position) {
        $position = models\Position::find()->byKey($position)->select('id');

        return $this->andWhere([
            'menu_position_id' => $position,
            'visible' => true,
        ]);
    }
}
