<?php
/**
 * Created by PhpStorm.
 * User: yanxs
 * Date: 2018/1/26
 * Time: 14:18
 */

namespace backend\models;


use yii\data\ActiveDataProvider;

class ProjectMsgSearch extends ProjectMsg
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
        $query = ProjectMsg::find()->joinWith(['user']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params, '');
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'project_id' => $this->project_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        //print_r($dataProvider);
        //exit;

        return $dataProvider;
    }
}