<?php

namespace backend\controllers;
use Yii;
use common\models\Areas;
//use common\components\Helper;
use yii\base\Object;

use backend\actions\CreateAction;
use backend\actions\UpdateAction;
use backend\actions\IndexAction;
use backend\actions\DeleteAction;
use backend\actions\ViewAction;


class AreasController extends \yii\web\Controller
{
    public function actions()
    {
        return [
            'index' => [
                'class' => IndexAction::className(),
                'data' => function () {
                    //Yii::$app->params['pageSize'] = 5;
                    $model = new Areas();
                    $province_list = $model->getAreasByParent();
                    $data = [
                        'model' => $model,
                        'provincelist' => $province_list,
                    ];
                    return $data;
                }
            ],
            /**/
            'create' => [
                'class' => CreateAction::className(),
                'modelClass' => Areas::className(),
                //'scenario' => 'backend',
            ],
            'update' => [
                'class' => UpdateAction::className(),
                'modelClass' => Areas::className(),
                //'scenario' => 'backend',
            ],
            'view-layer' => [
                'class' => ViewAction::className(),
                'modelClass' => Areas::className(),
            ],
            'delete' => [
                'class' => DeleteAction::className(),
                'modelClass' => Areas::className(),
            ],
        ];
    }
/**
     * 获取指定区域的下属信息
     */
   /* public function actionIndex(){
        ini_set("memory_limit","100M");
        $model = new Areas();
        $province_list = $model->getAreasByParent();
        return $this->render('index', [
            'model' => $model,
            'provincelist' => $province_list,
        ]);
        
    }*/
    public function actionAreaUpdate(){
        
        $data = Yii::$app->request->post();
        
        $model = new Areas();
        
        //添加
        if(isset($data['parent_id']))
        {
            $addData = ['parent_id' => $data['parent_id'],'area_name' => $data['area_name'],'sort' => 99];
            $area_id = $model->addArea($addData);
            $addData['area_id'] = $area_id;
            Helper::ajaxStatus(0,'',$addData);
        }
        //修改
        else
        {
            $updateData = array();
            if(isset($data['area_name']))
            {
                $updateData['area_name'] = $data['area_name'];
            }
        
            if(isset($data['area_sort']))
            {
                $updateData['sort'] = $data['area_sort'];
            }
            $model->updateAll($updateData,'area_id = '.$data['area_id']);
        }
    }
    
    public function actionAreaDel(){
        $area_id = Yii::$app->request->get('area_id');
        $area = new Areas();
        $res = $area->deleteAll(['area_id'=>$area_id]);
        Helper::ajaxReturn([]);
    }
    
    
}
