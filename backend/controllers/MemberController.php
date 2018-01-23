<?php
/**
 * Created by PhpStorm.
 * User: yanxs
 * Date: 2018/1/23
 * Time: 9:45
 */

namespace backend\controllers;


use backend\actions\CreateAction;
use backend\actions\DeleteAction;
use backend\actions\IndexAction;
use backend\actions\SortAction;
use backend\actions\StatusAction;
use backend\actions\UpdateAction;
use backend\models\MemberSearch;
use common\models\Member;
use yii\data\Sort;
use yii\web\Controller;
use yii;

class MemberController extends Controller
{
    public function actions()
    {
        return [
            'index' => [
                'class' => IndexAction::className(),
                'data' => function(){

                    $searchModel = new MemberSearch();
                    $dataProvider = $searchModel->search(yii::$app->getRequest()->getQueryParams());
                    return [
                        'dataProvider' => $dataProvider,
                        'searchModel' => $searchModel,
                    ];
                }
            ],
            'create' => [
                'class' => CreateAction::className(),
                'modelClass' => Member::className(),
                'scenario' => 'create',
                'data' => [
                    'beforeRun' => function(){
                        //单独处理密码
                        if(yii::$app->getRequest()->getIsPost()){

                            $password = Yii::$app->request->post('password');
                            $_POST['Member']['password'] = Yii::$app->getSecurity()->generatePasswordHash($password);
                            Yii::$app->request->setBodyParams($_POST);
                        }
                    }
                ]
            ],
            'update' => [
                'class' => UpdateAction::className(),
                'modelClass' => Member::className(),
                'scenario' => 'update',
                'data' => [
                    'beforeRun' => function(){
                        //单独处理密码
                        if(yii::$app->getRequest()->getIsPost()){
                            $post = Yii::$app->request->post();
                            $password = $post['Member']['password'];
                            if(empty($password)){
                                $model = Member::findOne(['id'=>yii::$app->getRequest()->get('id')]);
                                $password = $model->password;
                                $_POST['Member']['password'] = $password;
                            }else{
                                $_POST['Member']['password'] = Yii::$app->getSecurity()->generatePasswordHash($password);
                            }


                            Yii::$app->request->setBodyParams($_POST);
                        }
                    }
                ]
            ],
            'delete' => [
                'class' => DeleteAction::className(),
                'modelClass' => Member::className(),
            ],
            'sort' => [
                'class' => SortAction::className(),
                'modelClass' => Member::className(),
            ],
            'status' => [
                'class' => StatusAction::className(),
                'modelClass' => Member::className(),
            ]
        ];
    }
}