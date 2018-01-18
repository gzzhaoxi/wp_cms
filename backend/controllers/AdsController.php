<?php
/**
 * Created by PhpStorm.
 * User: yanxs
 * Date: 2018/1/18
 * Time: 11:37
 */

namespace backend\controllers;


use backend\actions\CreateAction;
use backend\actions\UpdateAction;
use yii;
use backend\actions\DeleteAction;
use backend\actions\IndexAction;
use backend\actions\SortAction;
use backend\actions\StatusAction;
use backend\models\AdsSearch;
use common\models\Ads;
use yii\web\Controller;

class AdsController extends Controller
{
    public function actions()
    {
        return [
            'index' => [
                'class' => IndexAction::className(),
                'data' => function(){

                    $searchModel = new AdsSearch();
                    $dataProvider = $searchModel->search(yii::$app->getRequest()->getQueryParams());
                    return [
                        'dataProvider' => $dataProvider,
                        'searchModel' => $searchModel,
                    ];
                }
            ],
            'create' => [
                'class' => CreateAction::className(),
                'modelClass' => Ads::className(),
                //'scenario' => 'backend',
                'data' => [
                    'beforeRun' => function(){
                        //单独处理相片逻辑
                        if(yii::$app->getRequest()->getIsPost()){
                            $photo = Yii::$app->request->post('photo');
                            $_POST['Ads']['photo'] = implode(',',$photo);
                            Yii::$app->request->setBodyParams($_POST);
                        }
                    }
                ]
            ],
            'update' => [
                'class' => UpdateAction::className(),
                'modelClass' => Ads::className(),
                'data' => [
                    'beforeRun' => function(){
                        //单独处理相片逻辑
                        if(yii::$app->getRequest()->getIsPost()){
                            $photo = Yii::$app->request->post('photo');
                            $_POST['Ads']['photo'] = implode(',',$photo);
                            Yii::$app->request->setBodyParams($_POST);
                        }
                    }
                ]
            ],
            'delete' => [
                'class' => DeleteAction::className(),
                'modelClass' => Ads::className(),
            ],
            'sort' => [
                'class' => SortAction::className(),
                'modelClass' => Ads::className(),
            ],
            'status' => [
                'class' => StatusAction::className(),
                'modelClass' => Ads::className(),
            ],
            'ueditor'=>[
                'class' => 'common\widgets\ueditor\UeditorAction',
                'config'=>[
                    //上传图片配置
                    'imageUrlPrefix' => "", /* 图片访问路径前缀 */
                    'imagePathFormat' => "/image/{yyyy}{mm}{dd}/{time}{rand:6}", /* 上传保存路径,可以自定义保存路径和文件名格式 */
                ]
            ]
        ];
    }

}