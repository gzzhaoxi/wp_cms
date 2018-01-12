<?php

namespace backend\controllers;

use Yii;
use backend\models\Receiver;
use backend\models\ReceiverSearch;
use backend\models\Customer;
use \yii\web\Controller;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Response;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use backend\actions\CreateAction;
use backend\actions\UpdateAction;
use backend\actions\IndexAction;
use backend\actions\DeleteAction;
use backend\actions\SortAction;
use backend\actions\StatusAction;


class ReceiverController extends Controller
{


    public function actions()
    {
        //phpinfo();
        //
        //$rs = Customer::getCustomerInfo(yii::$app->getRequest()->get('cid', ''));
        //if(!$rs) throw new InvalidParamException( 'Id is required');

        return [
            'index' => [
                'class' => IndexAction::className(),
                'data' => function () {
                    //Yii::$app->params['pageSize'] = 5;
                    //$model = new Receiver();
                    //$model->curr_customer_id = yii::$app->getRequest()->get('cid', '');
                    $searchModel = new ReceiverSearch();
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
                'modelClass' => Receiver::className(),
                //'scenario' => 'backend',
            ],

            'update' => [
                'class' => UpdateAction::className(),
                'modelClass' => Receiver::className(),
                //'scenario' => 'backend',
            ], */
            'get-region' => [
                'class' => \common\widgets\region\RegionAction::className(),
                'model' => \common\models\Region::className()
            ],

            'delete' => [
                'class' => DeleteAction::className(),
                'modelClass' => Receiver::className(),
            ],
            'sort' => [
                'class' => SortAction::className(),
                'modelClass' => Receiver::className(),
            ],
            'status' => [
                'class' => StatusAction::className(),
                'modelClass' => Receiver::className(),
            ],
        ];
    }

    //
    public function actionCreate()
    {
        //
        $model = new Receiver();

        if (yii::$app->getRequest()->getIsPost()) {
            //print_r(yii::$app->getRequest()->getIsPost());
            //exit;
            //
            Yii::$app->getResponse()->format = Response::FORMAT_JSON;

            if ($model->load(yii::$app->getRequest()->post()) && $model->save()) {
                Yii::$app->getSession()->setFlash('success', yii::t('app', 'Success'));
                return $this->redirect(['index', 'cid' => yii::$app->getRequest()->get('cid')]);
            } else {
                $errors = $model->getErrors();
                $err = '';
                foreach ($errors as $v) {
                    $err .= $v[0] . '<br>';
                }

                return [
                    'err_msg' => $err,
                ];
            }
        }

        //
        $model->loadDefaultValues();
        return $this->renderAjax('create', ['model' => $model]);
    }

    //
    public function actionUpdate()
    {
        //
        if(!yii::$app->getRequest()->get('id')) throw new BadRequestHttpException(yii::t('app', "Id doesn't exit"));
        $model = Receiver::findOne(yii::$app->getRequest()->get('id'));
        if (! $model) throw new BadRequestHttpException(yii::t('app', "Cannot find model by "));

        //
        if (yii::$app->getRequest()->getIsPost()) {
            //页面以AJAX打开执行返回JSON格式
            Yii::$app->getResponse()->format = Response::FORMAT_JSON;
            if ($model->load(Yii::$app->getRequest()->post()) && $model->validate() && $model->save()) {
                yii::$app->getSession()->setFlash('success', yii::t('app', 'Success'));
                return $this->redirect(['index', 'cid' => yii::$app->getRequest()->get('cid')]);
            } else {
                $errors = $model->getErrors();
                $err = '';
                foreach ($errors as $v) {
                    $err .= $v[0] . '<br>';
                }

                return [
                    'err_msg' => $err,
                ];
            }
        }

        //
        return $this->renderAjax('update', ['model' => $model]);
    }

    //
    public function actionLoadInfo($id){
        $options = Receiver::getUserAddress($id);

        if(isset($options) && count($options)>0){
            return Html::renderSelectOptions(
                isset($options['selected']) ? $options['selected'] : '',//
                ArrayHelper::merge([0 => Yii::t('app', 'pub_please_select')], $options['options'])
            );
        }else{
            return Html::renderSelectOptions(
                'address_id',//
                [0 => Yii::t('app', 'pub_unrecorder').','.Yii::t('app', 'pub_please_add')]
            );
        }

    }

    //非本控制器调用添加,外部引用添加,需要额外加入权限控制
    public function actionAddRefer(){
        //
        $model = new Receiver();

        if (yii::$app->getRequest()->getIsPost()) {

            Yii::$app->getResponse()->format = Response::FORMAT_JSON;

            if ($model->load(yii::$app->getRequest()->post()) && $model->save()) {
                Yii::$app->getSession()->setFlash('success', yii::t('app', 'Success'));
                return ['code' => 1];
            } else {
                $errors = $model->getErrors();
                $err = '';
                foreach ($errors as $v) {
                    $err .= $v[0] . '<br>';
                }

                return [
                    'err_msg' => $err,
                ];
            }
        }

        //
        $model->loadDefaultValues();
        return $this->renderAjax('create', ['model' => $model]);
    }
}
