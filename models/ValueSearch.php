<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Value;

/**
 * ValueSearch represents the model behind the search form of `app\models\Value`.
 */
class ValueSearch extends Value
{
    public $idPerson;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'person_link_value', 'id_attribute', 'id_data_portion', 'idPerson'], 'integer'],
            [['value', 'start_date_value', 'end_date_value'], 'safe'],
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
    public function search($params)
    {
        $query = Value::find()
                ->alias('v')
                ->select('v.*')
                ->joinWith('attributeObj a')
                ->orderBy('a.id_category, v.start_date_value, a.id')
                ;
        

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
                
        if($this->idPerson) {
            $query->joinWith('dataPortion dp');            
            $query->andWhere(['dp.id_person' => $this->idPerson]);            
        }
        
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'person_link_value' => $this->person_link_value,
            'start_date_value' => $this->start_date_value,
            'end_date_value' => $this->end_date_value,
            'id_attribute' => $this->id_attribute,
            'id_data_portion' => $this->id_data_portion,
        ]);

        $query->andFilterWhere(['ilike', 'value', $this->value]);

        return $dataProvider;
    }
}
