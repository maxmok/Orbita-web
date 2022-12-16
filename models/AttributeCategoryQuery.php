<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[AttributeCategory]].
 *
 * @see AttributeCategory
 */
class AttributeCategoryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AttributeCategory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AttributeCategory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
