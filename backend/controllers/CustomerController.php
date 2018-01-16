<?php

namespace backend\controllers;

use Yii;
use backend\models\customer;
use backend\models\CustomerSearch;

use backend\widgets\ActiveForm;
use yii\web\Response;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\libs\Constants;

use backend\actions\CreateAction;
use backend\actions\UpdateAction;
use backend\actions\IndexAction;
use backend\actions\DeleteAction;
use backend\actions\SortAction;
use backend\actions\StatusAction;
use backend\actions\ViewAction;

/**
 * Menu controller
 */
class CustomerController extends \yii\web\Controller
{

    public function actions()
    {
        return [
            'index' => [
                'class' => IndexAction::className(),
                'data' => function () {
                    //Yii::$app->params['pageSize'] = 5;
                    $searchModel = new CustomerSearch();
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
                'modelClass' => Customer::className(),
                //'scenario' => 'backend',
            ],
            'update' => [
                'class' => UpdateAction::className(),
                'modelClass' => Customer::className(),
                //'scenario' => 'backend',
            ],
            'view-layer' => [
                'class' => ViewAction::className(),
                'modelClass' => Customer::className(),
            ],
            'delete' => [
                'class' => DeleteAction::className(),
                'modelClass' => Customer::className(),
            ],
            'sort' => [
                'class' => SortAction::className(),
                'modelClass' => Customer::className(),
            ],
            'status' => [
                'class' => StatusAction::className(),
                'modelClass' => Customer::className(),
            ],
            'get-region' => [
                'class' => \common\widgets\region\RegionAction::className(),
                'model' => \common\models\Region::className()
            ],
        ];
    }

    //
    public function actionAddCustomer(){

        //
        $model = new Customer();

        if (yii::$app->getRequest()->getIsPost()) {

            //
            yii::$app->getResponse()->format = Response::FORMAT_JSON;

            if ($model->load(yii::$app->getRequest()->post()) && $model->save()) {
                Yii::$app->getSession()->setFlash('success', yii::t('app', 'Success'));
                //
                return ['code' => 1];
            } else {
                $errors = $model->getErrors();

                $err = '';
                foreach ($errors as $v) {
                    $err .= $v[0] . '<br>';
                }
                //
                return [
                    'err_msg' => $err,
                ];
            }
        }
        $model->loadDefaultValues();
        //$data = array_merge(['model' => $model], $this->data);
        return $this->renderAjax('create', ['model' => $model]);
    }


    //
    public function actionLoadInfo(){
        //
        $options = Customer::getClientInfo();

        return Html::renderSelectOptions(
            count($options),//
            ArrayHelper::merge([0 => Yii::t('app', 'pub_please_select')], $options)
        );
    }
}