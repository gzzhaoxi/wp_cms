<?php
/**
 * Created by PhpStorm.
 * User: yanxs
 * Date: 2018/1/18
 * Time: 15:08
 */

namespace backend\models;


use common\models\Ads;
use yii\data\ActiveDataProvider;

class AdsSearch extends Ads
{
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Ads::find();

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
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'title', $this->title]);

        //print_r($dataProvider);
        //exit;

        return $dataProvider;
    }
}