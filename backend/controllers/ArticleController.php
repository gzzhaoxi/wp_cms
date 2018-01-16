<?php
/**
 * Created by PhpStorm.
 * User: yanxs
 * Date: 2018/1/15
 * Time: 16:07
 */

namespace backend\controllers;

use backend\actions\CreateAction;
use backend\actions\UpdateAction;
use yii;
use backend\actions\DeleteAction;
use backend\actions\IndexAction;
use backend\actions\SortAction;
use backend\actions\StatusAction;
use backend\models\ArticleSearch;
use common\models\Article;

class ArticleController extends \yii\web\Controller
{
    public function actions()
    {
        return [
            'index' => [
                'class' => IndexAction::className(),
                'data' => function(){

                    $searchModel = new ArticleSearch();
                    $dataProvider = $searchModel->search(yii::$app->getRequest()->getQueryParams());
                    return [
                        'dataProvider' => $dataProvider,
                        'searchModel' => $searchModel,
                    ];
                }
            ],
            'create' => [
                'class' => CreateAction::className(),
                'modelClass' => Article::className(),
                //'scenario' => 'backend',
            ],
            'update' => [
                'class' => UpdateAction::className(),
                'modelClass' => Article::className(),
            ],
            'delete' => [
                'class' => DeleteAction::className(),
                'modelClass' => Article::className(),
            ],
            'sort' => [
                'class' => SortAction::className(),
                'modelClass' => Article::className(),
            ],
            'status' => [
                'class' => StatusAction::className(),
                'modelClass' => Article::className(),
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