<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Portion]].
 *
 * @see Portion
 */
class PortionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Portion[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Portion|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
