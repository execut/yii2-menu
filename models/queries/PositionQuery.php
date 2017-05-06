<?php

namespace execut\menu\models\queries;

/**
 * This is the ActiveQuery class for [[\execut\menu\models\Position]].
 *
 * @see \execut\menu\models\Position
 */
class PositionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \execut\menu\models\Position[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \execut\menu\models\Position|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function byKey($key) {
        return $this->andWhere([
            'key' => $key,
        ]);
    }
}
