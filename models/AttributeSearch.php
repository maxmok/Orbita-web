<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Attribute;

/**
 * AttributeSearch represents the model behind the search form of `app\models\Attribute`.
 */

class AttributeSearch extends Attribute
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_category', 'count_values'], 'integer'],
            [['attribute_name', 'short_name'], 'safe'],
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
        $query = Attribute::find();
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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_category' => $this->id_category,
            'count_values' => $this->count_values,
        ]);

        $query->andFilterWhere(['ilike', 'attribute_name', $this->attribute_name])
            ->andFilterWhere(['ilike', 'short_name', $this->short_name]);

            
        return $dataProvider;
    }
}
