<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Production;

/**
 * ProductionSearch represents the model behind the search form about `backend\models\Production`.
 */
class ProductionSearch extends Production
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'code', 'type', 'status', 'created_at', 'updated_at', 'print_type'], 'integer'],
            [['price'], 'double'],
            [['name', 'size', 'unit', 'paper', 'weight', 'pages'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Production::find();

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
            'id'         => $this->id,
            'code'       => $this->code,
            'type'       => $this->type,
            'status'     => $this->status,
            'print_type' => $this->print_type,
            'price'      => $this->price,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'size', $this->size])
            ->andFilterWhere(['like', 'unit', $this->unit])
            ->andFilterWhere(['like', 'print_type', $this->print_type])
            ->andFilterWhere(['like', 'paper', $this->paper])
            ->andFilterWhere(['like', 'weight', $this->weight])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'pages', $this->pages]);


        return $dataProvider;
    }
}
