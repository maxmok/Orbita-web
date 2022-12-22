<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

use app\models\Value;

use yii\db\Query;
/**
 * 
 */

class SearchModel extends Model
{
    public $id, $id_person;
    public $first_name, $second_name, $father_name;
    public $b_day, $b_month, $b_year;
    public $min_age, $max_age;
    public $inn, $tabn, $project, $tel, $email;
    public $is_like;
            
    
    /**
     * {@inheritdoc}
     */
    
    public function rules()
    {
        return [
            [['id', 'id_person', 'tel'], 'integer'],
            ['first_name', 'filter', 'filter' => function($val) {return $val ? mb_strtolower($val): null;}],
            [['first_name', 'second_name', 'father_name', 'is_like', 'inn', 'tabn', 'project', 'email'], 'safe'],                              
        ];
    }
    
    public function attributeLabels() {
        return [            
            'first_name' => 'Фамилия',
            'second_name' => 'Имя',
            'father_name' => 'Отчество',
            'b_day' => 'День рождения',
            'b_month' => 'Месяц рождения',
            'b_year' => 'Год рождения',
            'min_age' => 'Возраст от:',
            'max_age' => 'Возраст до:',
            'inn' => 'ИНН организации работника',
            'tabn' => 'Таб. №',
            'project' => 'В проекте',
            'tel' => 'Телефон',
            'email' => 'E-mail',
            'is_like' => 'Использовать неточные совпадения',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider
    {
        // (select value from attribute_value where id_data_portion = dp.id and id_attribute = 6 limit 1) as fio
        $subQueryFio = (new Query())->select('value')->from('attribute_value')->where('id_data_portion = p.id and id_attribute = 6')->limit(1);        
        
        $query = Value::find()
                ->alias('av')
                ->innerJoinWith('dataPortion p', false)
                ->distinct()
                ->select('p.id_person as id')
                ->addSelect(['fio' => $subQueryFio]);        
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
           // 'key' => 'id_person'
//            'sort' => $this->createSort(),
        ]);
        
        $this->load($params);
              
        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }        
        
        $ids = $this->getIds();
        
        if (count($ids) == 0) {
            $query->where('0=1');
            return $dataProvider;
        }
        
        if (count($ids) > 0) {
            $query->where(['p.id_person' => $ids])
                  ->andWhere(['av.id_attribute' => 6]);
        }        
        
        /*$rows = $query->asArray()->all();
        $models = []; 
        foreach($rows as $row) {
            $models[] = new SearchModel($row);
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $models
        ]);*/
        $query->asArray();
        //$query->all();
        
        return $dataProvider;
    }  
    
    private function getIds(): array {                        
        $ids = [];                
        $attributes = array_filter($this->getAttributes());                   
        foreach ($attributes as $key => $attributeValue){    
            if ($key == 'is_like' || $attributeValue == '-1'){
                continue;
            } elseif (str_contains($key, 'b_')) { // birthday
                $ids = $this->getIdsByBirthday($key, $attributeValue, $ids);
            } elseif (str_contains($key, 'min_') || str_contains($key, 'max_')){ // age
                $ids = $this->getIdsByAge($ids);
            } else { // другие атрибуты
                $ids = $this->getIdsByAttributeValue($key, $attributeValue, $ids);
            }
                        
            if (!$ids) {
               break;
            }
        }
        return $ids;
    }
    
    private function getIdsByBirthday($name, $value, $idsPrev): array {
        $query = Person::find();
        if (count($idsPrev) > 0){
            $query->andFilterWhere(['id' => $idsPrev]);
        }            
        $field = explode('_', $name)[1];        
        return $query->andFilterWhere(["extract($field from birth_date)", $value])->column();        
    }
    
    private function getIdsByAge($idsPrev): array {
        $query = Person::find();
        if (count($idsPrev) > 0){
            $query->andFilterWhere(['id' => $idsPrev]);
        }                    
        $attributes = array_filter($this->getAttributes());
        if (array_key_exists('max_age', $attributes)){
            $query->andFilterWhere(['<', "date_part('year', age(birth_date))", $attributes['max_age']]);
        }
        if (array_key_exists('min_age', $attributes)){
            $query->andFilterWhere(['>', "date_part('year', age(birth_date))", $attributes['min_age']]);
        }            
        
        return $query->column();        
    }
    
    private function getIdsByAttributeValue($key, $value, $idsPrev): array {                          
        $lables = $this->attributeLabels();       
        $attributeName = $lables[$key];        
       
        $operator = $this->is_like == 1 ? 'like' : '=';        
        if ($attributeName) {    
            $query = Value::find()
                ->alias('av')
                ->innerJoinWith('dataPortion p', false)
                ->innerJoin(['a' => 'attribute'], 'a.id = av.id_attribute')
                ->select('p.id_person as id_person')
                ->distinct()
                ->asArray()
                ->andFilterWhere([$operator, 'lower(av.value)', mb_strtolower($value)])
                ->andWhere(['a.attribute_name' => $attributeName]);            

            if (count($idsPrev) > 0){
                $query->andFilterWhere(['p.id_person' => $idsPrev]);
            }                                        
            return $query->column();    
        }
        return [];
    }            
}
