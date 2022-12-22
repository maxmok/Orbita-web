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
    
    public static function getDays():array {        
        $list = [];
        $list[0] = '';
        for ($i=1; $i<=31; $i++){
            $list[$i] = $i;        
        }                    
        return $list;
    }
    
    public static function getMonths():array {
        $months = self::find()
                ->select(["to_char(birth_date, 'TMMonth') as name", "EXTRACT(month FROM birth_date) as index"])
                ->orderBy('index')
                ->distinct()
                ->column();
        $list = [];
        $list[0] = '';
        foreach($months as $index => $month) {
            $list[$index+1] = $month;
        }
        return $list;
        
//        $list[1] = 'Январь';
//        $list[2] = 'Февраль';
//        $list[3] = 'Март';
//        $list[4] = 'Апрель';
//        $list[5] = 'Май';
//        $list[6] = 'Июнь';
//        $list[7] = 'Июль';
//        $list[8] = 'Август';
//        $list[9] = 'Сентябрь';
//        $list[10] = 'Октябрь';
//        $list[11] = 'Ноябрь';
//        $list[12] = 'Декабрь';        
    }
    
    public static function getYears():array {
        $years = self::find()
                ->select("EXTRACT(Year FROM birth_date) as index")
                ->orderBy('index')
                ->distinct()
                ->column();
        $list = [];
        $list[0] = '';
        foreach($years as $year) {
            $list[$year] = $year;
        }
        return $list;
        
//        $list[1] = 'Январь';
//        $list[2] = 'Февраль';
//        $list[3] = 'Март';
//        $list[4] = 'Апрель';
//        $list[5] = 'Май';
//        $list[6] = 'Июнь';
//        $list[7] = 'Июль';
//        $list[8] = 'Август';
//        $list[9] = 'Сентябрь';
//        $list[10] = 'Октябрь';
//        $list[11] = 'Ноябрь';
//        $list[12] = 'Декабрь';        
    }
}
