<?php

namespace backend\controllers;

use backend\components\Rbac;
use backend\models\AdminRoleUser;
use backend\models\Customer;
use Yii;
use \yii\web\Controller;
use backend\models\Order;
use backend\models\OrderSearch;

use backend\actions\CreateAction;
use backend\actions\UpdateAction;
use backend\actions\IndexAction;
use backend\actions\DeleteAction;
use backend\actions\SortAction;
use backend\actions\StatusAction;


class OrderController extends Controller
{
    public function actions()
    {
        return [
            'index' => [
                'class' => IndexAction::className(),
                'data' => function () {
                    //Yii::$app->params['pageSize'] = 5;
                    $searchModel = new OrderSearch();
                    $dataProvider = $searchModel->search(yii::$app->getRequest()->getQueryParams());
                    $data = [
                        'dataProvider' => $dataProvider,
                        'searchModel' => $searchModel,
                    ];
                    return $data;
                }
            ],
            /*
            'create' => [
                'class' => CreateAction::className(),
                'modelClass' => Order::className(),
                //'scenario' => 'backend',
            ],
            'update' => [
                'class' => UpdateAction::className(),
                'modelClass' => Order::className(),
                //'scenario' => 'backend',
            ],
            */
            'delete' => [
                'class' => DeleteAction::className(),
                'modelClass' => Order::className(),
            ],
            'sort' => [
                'class' => SortAction::className(),
                'modelClass' => Order::className(),
            ],
            'status' => [
                'class' => StatusAction::className(),
                'modelClass' => Order::className(),
            ],
        ];
    }

    //
    public function actionCreate(){
        //
        $model = new Order();

        //print_r(Customer::getClientInfo());


        $data = [
            'model' => $model,
        ];
        return $this->render('create', $data);
    }


//end of class
}
