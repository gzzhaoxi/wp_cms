<?php
/**
 * Created by PhpStorm.
 * User: yanxs
 * Date: 2018/1/19
 * Time: 11:24
 */

namespace backend\controllers;

use backend\actions\CreateAction;
use backend\actions\UpdateAction;
use backend\models\PlanSearch;
use common\models\Plan;
use yii;
use backend\actions\DeleteAction;
use backend\actions\IndexAction;
use backend\actions\SortAction;
use backend\actions\StatusAction;
use yii\web\Controller;

class PlanController extends Controller
{
    public function actions()
    {
        return [
            'index' => [
                'class' => IndexAction::className(),
                'data' => function(){

                    $searchModel = new PlanSearch();
                    $dataProvider = $searchModel->search(yii::$app->getRequest()->getQueryParams());
                    return [
                        'dataProvider' => $dataProvider,
                        'searchModel' => $searchModel,
                    ];
                }
            ],
            'create' => [
                'class' => CreateAction::className(),
                'modelClass' => Plan::className(),
                //'scenario' => 'backend',
                'data' => [
                    'beforeRun' => function(){
                        //单独处理相片逻辑
                        $this->setPost();
                    }
                ]
            ],
            'update' => [
                'class' => UpdateAction::className(),
                'modelClass' => Plan::className(),
                'data' => [
                    'beforeRun' => function(){
                        //单独处理相片逻辑
                        $this->setPost();
                    }
                ]
            ],
            'delete' => [
                'class' => DeleteAction::className(),
                'modelClass' => Plan::className(),
            ],
            'sort' => [
                'class' => SortAction::className(),
                'modelClass' => Plan::className(),
            ],
            'status' => [
                'class' => StatusAction::className(),
                'modelClass' => Plan::className(),
            ]
        ];
    }

    private function setPost(){
        if(yii::$app->getRequest()->getIsPost()){
            $detail = Yii::$app->request->post('detail');
            //把这组数据组成json
            $arr_detail = [];
            foreach($detail['val'] as $k=>$v){
                if(!empty($v)){
                    $arr_detail[$k]['val'] = $v;
                    $arr_detail[$k]['sort'] = $detail['sort'][$k];
                }
            }

            $post_detail = json_encode($arr_detail);
            $_POST['Plan']['detail'] = $post_detail;
            Yii::$app->request->setBodyParams($_POST);

        }
    }
}