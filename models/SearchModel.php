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
    public $id, $id_person, $value, $is_like;
    
    /**
     * {@inheritdoc}
     */
    
    public function rules()
    {
        return [
            [['id', 'id_person'], 'integer'],
            ['value', 'filter', 'filter' => function($val) {return $val ? mb_strtolower($val): null;}],
            [['value', 'is_like'], 'safe'],
        ];
    }
    
    public function attributeLabels() {
        return [
            'id_person' => 'ID объекта'
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
            'key' => 'id_person'
//            'sort' => $this->createSort(),
        ]);
        
        $this->load($params);
      
        
        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }
        $operator = $this->is_like ? 'ilike' : "=";
        $query->andFilterWhere([$operator, 'lower(av.value)', $this->value]);
        if(!$this->value) {
            $query->andWhere('1=0');
        }
        $query->select('p.id_person as id_person')->asArray();
        $query2 = clone $query;
        $ids = $query2->select('p.id_person as id_person')->distinct()->column();
        
        return $dataProvider;
    }
}
