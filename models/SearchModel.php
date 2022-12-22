<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

use app\models\Value;
use app\models\Portion;
/**
 * 
 */

class SearchModel extends Model
{
    public $id, $id_person;
    public $first_name, $second_name, $father_name;
    public $b_day, $b_month, $b_year;
    public $min_age, $max_age;
    public $inn, $tabn, $project, $part_project,$tel, $email;
    public $main_id;
            
    
    /**
     * {@inheritdoc}
     */
    
    public function rules()
    {
        return [
            [['id', 'id_person', 'main_id', 'tel'], 'integer'],
            ['first_name', 'filter', 'filter' => function($val) {return $val ? mb_strtolower($val): null;}],
            [['first_name', 'second_name', 'father_name'], 'safe'],
                  
        ];
    }
    
    public function attributeLabels() {
        return [
            'id_person' => 'ID объекта',
            'first_name' => "Фамилия",
            'second_name' => "Имя",
            'father_name' => "Отчество",
            'b_day' => 'День рождения',
            'b_month' => 'Месяц рождения',
            'b_year' => 'Год рождения',
            'main_id' => 'Код объекта'
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
        $query = Value::find()->alias('av')->innerJoinWith('dataPortion p', false);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
//            'key' => 'id_person'
//            'sort' => $this->createSort(),
        ]);
        
        $this->load($params);
      
        
        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }
        //var_dump(array_filter($this->getAttributes()));
        //die(1);
        
        $ids = $this->getIds();
        
        $query->where(['p.id_person' => $ids]);
        
        return $dataProvider;
    }  
    
    private function getIds(): array {
        
        if($this->main_id) {
            return [$this->main_id];
        }
        
        $query = Value::find()->alias('av')->innerJoinWith('dataPortion p', false);

        $attributes = array_filter($this->getAttributes());
        foreach ($attributes as $attribute){
            $operator = 'like';
            $query->andFilterWhere([$operator, 'lower(av.value)', $attribute]);
            $query->select('p.id_person as id_person')->asArray();
            $ids = $query->select('p.id_person as id_person')->distinct()->column();
        }
        return $ids;
    }
}
