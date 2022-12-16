<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "attribute_category".
 *
 * @property int $id
 * @property string $name
 * @property int $id_parent_category
 *
 * @property Attribute[] $attributes0
 */
class AttributeCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'attribute_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['id_parent_category'], 'default', 'value' => null],
            [['id_parent_category'], 'integer'],
            [['name'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'id_parent_category' => 'Id Parent Category',
        ];
    }

    /**
     * Gets query for [[Attributes0]].
     *
     * @return \yii\db\ActiveQuery|AttributeQuery
     */
    public function getAttributes0()
    {
        return $this->hasMany(Attribute::class, ['id_category' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return AttributeCategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AttributeCategoryQuery(get_called_class());
    }
}
