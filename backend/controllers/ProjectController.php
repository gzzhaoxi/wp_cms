<?php
/**
 * Created by PhpStorm.
 * User: yanxs
 * Date: 2018/1/25
 * Time: 16:46
 */

namespace backend\controllers;

use backend\actions\CreateAction;
use backend\actions\UpdateAction;
use backend\actions\ViewAction;
use common\models\Projects;
use yii;
use backend\actions\DeleteAction;
use backend\actions\IndexAction;
use backend\actions\SortAction;
use backend\actions\StatusAction;
use backend\models\ProjectSearch;
use yii\web\Controller;

class ProjectController extends Controller
{
    public function actions()
    {
        return [
            'index' => [
                'class' => IndexAction::className(),
                'data' => function(){

                    $searchModel = new ProjectSearch();
                    $dataProvider = $searchModel->search(yii::$app->getRequest()->getQueryParams());
                    return [
                        'dataProvider' => $dataProvider,
                        'searchModel' => $searchModel,
                    ];
                }
            ],
            'create' => [
                'class' => CreateAction::className(),
                'modelClass' => Projects::className(),
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
                'modelClass' => Projects::className(),
                'data' => [
                    'beforeRun' => function(){
                        //单独处理相片逻辑
                       // $this->setPost();
                    }
                ]
            ],
            'view' => [
                'class' => ViewAction::className(),
                'modelClass' => Projects::className(),
            ],
            'delete' => [
                'class' => DeleteAction::className(),
                'modelClass' => Projects::className(),
            ],
            'sort' => [
                'class' => SortAction::className(),
                'modelClass' => Projects::className(),
            ],
            'status' => [
                'class' => StatusAction::className(),
                'modelClass' => Projects::className(),
            ]
        ];
    }

}