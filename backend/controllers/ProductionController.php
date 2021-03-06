<?php

namespace backend\controllers;

use Yii;
use backend\models\Production;
use backend\models\ProductionSearch;
use common\libs\Constants;
use backend\models\Pdsetting;

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use yii\base\InvalidParamException;

use backend\actions\CreateAction;
use backend\actions\UpdateAction;
use backend\actions\IndexAction;
use backend\actions\DeleteAction;
use backend\actions\SortAction;
use backend\actions\StatusAction;
use backend\actions\ViewAction;

//
class ProductionController extends \yii\web\Controller
{
    public function actions()
    {
        return [
            'index' => [
                'class' => IndexAction::className(),
                'data' => function () {
                    //Yii::$app->params['pageSize'] = 5;
                    $searchModel = new ProductionSearch();
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
                'modelClass' => Production::className(),
                //'scenario' => 'backend',
            ],
            'update' => [
                'class' => UpdateAction::className(),
                'modelClass' => Production::className(),
                //'scenario' => 'backend',
            ],
            'view-layer' => [
                'class' => ViewAction::className(),
                'modelClass' => Production::className(),
            ],
            'delete' => [
                'class' => DeleteAction::className(),
                'modelClass' => Production::className(),
            ],
            'sort' => [
                'class' => SortAction::className(),
                'modelClass' => Production::className(),
            ],
            'status' => [
                'class' => StatusAction::className(),
                'modelClass' => Production::className(),
            ],
        ];
    }

//end of class
}
