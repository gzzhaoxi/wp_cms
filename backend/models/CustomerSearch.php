<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\customer;
use yii\helpers\ArrayHelper;

/**
 * CustomerSearch represents the model behind the search form about `backend\models\customer`.
 */
class CustomerSearch extends customer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'serial_no', 'status', 'level', 'sales_id', 'recommend_id', 'type', 'trade_type', 'province', 'city', 'district', 'created_at', 'updated_at'], 'integer'],
            [['name', 'nickname', 'linkman', 'tel', 'mobile', 'qq', 'address'], 'safe'],
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
        $query = customer::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            'pagination' => [
                'pageSize' => Yii::$app->params['pageSize'],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        //如果是超管或管理员则看到所有客户信息
        //否则只看到自己管理的客户信息
        $curr_admin_role_id = AdminRoleUser::getRoleIdByUid();
        if(!ArrayHelper::isIn($curr_admin_role_id, [AdminRoleUser::ROLE_FOR_ADMIN,AdminRoleUser::ROLE_FOR_SUPER])){
            $query->andFilterWhere(['sales_id' => yii::$app->getUser()->getIdentity()->getId()]);
        }

        //echo $query->createCommand()->getRawSql();
        //exit;
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'serial_no' => $this->serial_no,
            'status' => $this->status,
            'level' => $this->level,
            'sales_id' => $this->sales_id,
            'recommend_id' => $this->recommend_id,
            'type' => $this->type,
            'trade_type' => $this->trade_type,
            'province' => $this->province,
            'city' => $this->city,
            'district' => $this->district,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'nickname', $this->nickname])
            ->andFilterWhere(['like', 'linkman', $this->linkman])
            ->andFilterWhere(['like', 'tel', $this->tel])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'qq', $this->qq])
            ->andFilterWhere(['like', 'address', $this->address]);

        return $dataProvider;
    }
}
