<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "person".
 *
 * @property int $id
 * @property string|null $birth_date
 * @property string|null $death_date
 *
 * @property DataPortion[] $dataPortions
 */
class Person extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'person';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['birth_date', 'death_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'birth_date' => 'Birth Date',
            'death_date' => 'Death Date',
        ];
    }

    /**
     * Gets query for [[DataPortions]].
     *
     * @return \yii\db\ActiveQuery|DataPortionQuery
     */
    public function getDataPortions()
    {
        return $this->hasMany(DataPortion::class, ['id_person' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return PersonQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PersonQuery(get_called_class());
    }
}
