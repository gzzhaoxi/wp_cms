<?php
/**
 * Created by PhpStorm.
 * User: yanxs
 * Date: 2018/1/26
 * Time: 14:19
 */

namespace backend\controllers;

use backend\actions\CreateAction;
use backend\actions\UpdateAction;
use backend\actions\ViewAction;
use backend\models\ProjectMsg;
use yii;
use backend\actions\DeleteAction;
use backend\actions\IndexAction;
use backend\actions\SortAction;
use backend\actions\StatusAction;
use backend\models\ProjectMsgSearch;
use yii\web\Controller;

class ProjectMsgController extends Controller
{
    public function actions()
    {
        return [
            'index' => [
                'class' => IndexAction::className(),
                'data' => function(){

                    $searchModel = new ProjectMsgSearch();
                    $dataProvider = $searchModel->search(yii::$app->getRequest()->getQueryParams());
                    return [
                        'dataProvider' => $dataProvider,
                        'searchModel' => $searchModel,
                    ];
                }
            ],
            'create' => [
                'class' => CreateAction::className(),
                'modelClass' => ProjectMsg::className(),
                //'scenario' => 'backend',
                'data' => [
                    'beforeRun' => function(){
                        //单独处理相片逻辑
                        // $this->setPost();
                    }
                ]
            ],
            'update' => [
                'class' => UpdateAction::className(),
                'modelClass' => ProjectMsg::className(),
                'data' => [
                    'beforeRun' => function(){
                        //单独处理相片逻辑
                        // $this->setPost();
                    }
                ]
            ],
            'view' => [
                'class' => ViewAction::className(),
                'modelClass' => ProjectMsg::className(),
            ],
            'delete' => [
                'class' => DeleteAction::className(),
                'modelClass' => ProjectMsg::className(),
            ],
            'sort' => [
                'class' => SortAction::className(),
                'modelClass' => ProjectMsg::className(),
            ],
            'status' => [
                'class' => StatusAction::className(),
                'modelClass' => ProjectMsg::className(),
            ]
        ];
    }
}