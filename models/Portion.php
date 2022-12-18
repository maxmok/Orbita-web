<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "data_portion".
 *
 * @property int $id
 * @property string $source_date
 * @property string|null $source
 * @property int|null $row_number
 * @property int $id_source_file
 * @property int $id_person
 * @property int $is_primary
 *
 * @property AttributeValue[] $attributeValues
 * @property Person $person
 * @property DataFile $sourceFile
 */
class Portion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'data_portion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['source_date'], 'safe'],
            [['row_number', 'id_source_file', 'id_person', 'is_primary'], 'default', 'value' => null],
            [['row_number', 'id_source_file', 'id_person', 'is_primary'], 'integer'],
            [['id_source_file', 'id_person'], 'required'],
            [['source'], 'string', 'max' => 500],
            [['id_source_file'], 'exist', 'skipOnError' => true, 'targetClass' => DataFile::class, 'targetAttribute' => ['id_source_file' => 'id']],
            [['id_person'], 'exist', 'skipOnError' => true, 'targetClass' => Person::class, 'targetAttribute' => ['id_person' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'source_date' => 'Source Date',
            'source' => 'Source',
            'row_number' => 'Row Number',
            'id_source_file' => 'Id Source File',
            'id_person' => 'Id Person',
            'is_primary' => 'Is Primary',
        ];
    }

    /**
     * Gets query for [[AttributeValues]].
     *
     * @return \yii\db\ActiveQuery|AttributeValueQuery
     */
    public function getAttributeValues()
    {
        return $this->hasMany(AttributeValue::class, ['id_data_portion' => 'id']);
    }

    /**
     * Gets query for [[Person]].
     *
     * @return \yii\db\ActiveQuery|PersonQuery
     */
    public function getPerson()
    {
        return $this->hasOne(Person::class, ['id' => 'id_person']);
    }

    /**
     * Gets query for [[SourceFile]].
     *
     * @return \yii\db\ActiveQuery|DataFileQuery
     */
    public function getSourceFile()
    {
        return $this->hasOne(DataFile::class, ['id' => 'id_source_file']);
    }

    /**
     * {@inheritdoc}
     * @return PortionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PortionQuery(get_called_class());
    }
}
