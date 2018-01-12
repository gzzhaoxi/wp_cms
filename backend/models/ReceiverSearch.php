<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Receiver;

/**
 * ReceiverSearch represents the model behind the search form about `backend\models\Receiver`.
 */
class ReceiverSearch extends Receiver
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at', 'customer_id', 'province', 'city', 'district', 'zipcode', 'is_default', 'is_delete'], 'integer'],
            [['receiver_name', 'tel', 'address', 'building'], 'safe'],
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
        $query = Receiver::find();

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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'customer_id' => $params['cid'],//$this->customer_id,
            'province' => $this->province,
            'city' => $this->city,
            'district' => $this->district,
            'zipcode' => $this->zipcode,
            'is_default' => $this->is_default,
            'is_delete' => $this->is_delete,
        ]);

        $query
            ->andFilterWhere(['like', 'receiver_name', $this->receiver_name])
            ->andFilterWhere(['like', 'tel', $this->tel])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'building', $this->building]);

        return $dataProvider;
    }
}
