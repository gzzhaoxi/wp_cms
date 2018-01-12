<?php

namespace backend\controllers;

use Yii;
use backend\models\Rank;
use backend\models\RankSearch;

use backend\actions\CreateAction;
use backend\actions\UpdateAction;
use backend\actions\IndexAction;
use backend\actions\DeleteAction;
use backend\actions\SortAction;
use backend\actions\StatusAction;

/**
 * Menu controller
 */
class RankController extends \yii\web\Controller
{

    public function actions()
    {
        return [
            'index' => [
                'class' => IndexAction::className(),
                'data' => function () {
                    //Yii::$app->params['pageSize'] = 5;
                    $searchModel = new RankSearch();
                    $dataProvider = $searchModel->search(yii::$app->getRequest()->getQueryParams());
                    $data = [
                        'dataProvider' => $dataProvider,
                        'searchModel' => $searchModel,
                    ];
                    return $data;
                }
            ],
            'create' => [
                'class' => CreateAction::className(),
                'modelClass' => Rank::className(),
                //'scenario' => 'backend',
            ],
            'update' => [
                'class' => UpdateAction::className(),
                'modelClass' => Rank::className(),
                //'scenario' => 'backend',
            ],
            'delete' => [
                'class' => DeleteAction::className(),
                'modelClass' => Rank::className(),
            ],
            'sort' => [
                'class' => SortAction::className(),
                'modelClass' => Rank::className(),
            ],
            'status' => [
                'class' => StatusAction::className(),
                'modelClass' => Rank::className(),
            ],
        ];
    }
}