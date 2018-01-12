<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Order;

/**
 * OrderSearch represents the model behind the search form about `backend\models\Order`.
 */
class OrderSearch extends Order
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at', 'customer_id', 'sales_id', 'project_id', 'address_id', 'status_pay', 'status_confirm', 'status_send', 'express_type', 'remark'], 'integer'],
            [['order_no', 'express_code', 'produce_content'], 'safe'],
            [['prepay_amount', 'unpay_amount', 'free_amount', 'discount', 'express_cost'], 'number'],
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
        $query = Order::find();

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
            'customer_id' => $this->customer_id,
            'sales_id' => $this->sales_id,
            'project_id' => $this->project_id,
            'address_id' => $this->address_id,
            'prepay_amount' => $this->prepay_amount,
            'unpay_amount' => $this->unpay_amount,
            'free_amount' => $this->free_amount,
            'discount' => $this->discount,
            'express_cost' => $this->express_cost,
            'status_pay' => $this->status_pay,
            'status_confirm' => $this->status_confirm,
            'status_send' => $this->status_send,
            'express_type' => $this->express_type,
            'remark' => $this->remark,
        ]);

        $query->andFilterWhere(['like', 'order_no', $this->order_no])
            ->andFilterWhere(['like', 'express_code', $this->express_code])
            ->andFilterWhere(['like', 'produce_content', $this->produce_content]);

        return $dataProvider;
    }
}
