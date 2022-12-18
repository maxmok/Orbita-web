<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "attribute".
 *
 * @property int $id
 * @property string $attribute_name
 * @property string|null $short_name
 * @property int $id_category
 * @property int|null $count_values
 */
class Attribute extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'attribute';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['attribute_name'], 'required'],
            [['id_category'], 'default', 'value' => 1],
            [['count_values'], 'default', 'value' => 0],
            [['id_category', 'count_values'], 'integer'],
            [['attribute_name', 'short_name'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'attribute_name' => 'Название',
            'short_name' => 'Короткое название',
            'id_category' => 'Категория',
            'count_values' => 'Количество значений',
        ];
    }
    
}
