<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "attribute_value".
 *
 * @property int $id
 * @property string $value
 * @property int|null $person_link_value
 * @property string|null $start_date_value
 * @property string|null $end_date_value
 * @property int $id_attribute
 * @property int $id_data_portion
 *
 * @property Attribute $attribute0
 * @property DataPortion $dataPortion
 */
class Value extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'attribute_value';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['person_link_value', 'id_attribute', 'id_data_portion'], 'default', 'value' => null],
            [['person_link_value', 'id_attribute', 'id_data_portion'], 'integer'],
            [['start_date_value', 'end_date_value'], 'safe'],
            [['id_attribute', 'id_data_portion'], 'required'],
            [['value'], 'string', 'max' => 1000],
            [['id_attribute'], 'exist', 'skipOnError' => true, 'targetClass' => Attribute::class, 'targetAttribute' => ['id_attribute' => 'id']],
            [['id_data_portion'], 'exist', 'skipOnError' => true, 'targetClass' => DataPortion::class, 'targetAttribute' => ['id_data_portion' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'value' => 'Значение',
            'person_link_value' => 'Ссылка на другой объект',
            'start_date_value' => 'Начало атрибута',
            'end_date_value' => 'Окончание атрибута',
            'id_attribute' => 'Код атрибута',
            'id_data_portion' => 'Id Data Portion',
        ];
    }

    /**
     * Gets query for [[Attribute0]].
     *
     * @return \yii\db\ActiveQuery|AttributeQuery
     */
    public function getAttribute0()
    {
        return $this->hasOne(Attribute::class, ['id' => 'id_attribute']);
    }

    /**
     * Gets query for [[DataPortion]].
     *
     * @return \yii\db\ActiveQuery|DataPortionQuery
     */
    public function getDataPortion()
    {
        return $this->hasOne(Portion::class, ['id' => 'id_data_portion']);
    }

    /**
     * {@inheritdoc}
     * @return ValueQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ValueQuery(get_called_class());
    }
}
