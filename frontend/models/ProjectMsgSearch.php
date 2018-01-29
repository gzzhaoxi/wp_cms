<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProjectMsg;
use common\models\Projects;

/**
 * ProjectMsgSearch represents the model behind the search form about `common\models\ProjectMsg`.
 */
class ProjectMsgSearch extends ProjectMsg
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'project_id', 'created_at', 'updated_at', 'user_id'], 'integer'],
            [['name', 'tel', 'email', 'msg'], 'safe'],
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
        $query = ProjectMsg::find()->joinWith(['project']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->andFilterWhere([ProjectMsg::tableName().'.user_id' => Yii::$app->getUser()->id]);
        // grid filtering conditions
       /*  $query->andFilterWhere([
            'project_id' => $this->project_id,
        ]); */
        
        $query->andFilterWhere(['or',['like', ProjectMsg::tableName().'.name', $this->msg],['like', ProjectMsg::tableName().'.tel', $this->msg],['like', ProjectMsg::tableName().'.email', $this->msg],['like', ProjectMsg::tableName().'.msg', $this->msg],['like', Projects::tableName().'.name', $this->msg]]);
            
        
        $query->orderBy(ProjectMsg::tableName().'.created_at DESC');
        
        return $dataProvider;
    }
}
