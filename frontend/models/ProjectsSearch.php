<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Projects;

/**
 * ProjectsSearch represents the model behind the search form about `common\models\Projects`.
 */
class ProjectsSearch extends Projects
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'must_input', 'created_at', 'updated_at', 'hit', 'user_id'], 'integer'],
            [['name', 'office_name', 'address', 'link', 'msg', 'photo'], 'safe'],
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
        $query = Projects::find();

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
        $query->andFilterWhere([
            'user_id' => Yii::$app->getUser()->id,
        ]);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'must_input' => $this->must_input,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'hit' => $this->hit,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'office_name', $this->office_name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'msg', $this->msg])
            ->andFilterWhere(['like', 'photo', $this->photo]);
        $query->orderBy('id DESC');
        return $dataProvider;
    }
}
