<?php

namespace backend\controllers;

use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use yii\base\InvalidParamException;
use common\libs\Tree;

use backend\models\Category;
use backend\models\CategorySearch;
use common\libs\Constants;

use backend\actions\CreateAction;
use backend\actions\UpdateAction;
use backend\actions\IndexAction;
use backend\actions\DeleteAction;
use backend\actions\SortAction;
use backend\actions\StatusAction;
use backend\actions\ViewAction;

class CategoryController extends \yii\web\Controller
{
    //
    protected $categorylist = [];
    protected $categorydata = [];

    //
    public function actions()
    {
        return [
             'index' => [
                'class' => IndexAction::className(),
                'data' => function () {
                    //Yii::$app->params['pageSize'] = 5;
                    $searchModel = new CategorySearch();
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
                'modelClass' => Category::className(),
                //'scenario' => 'backend',
            ],
            'update' => [
                'class' => UpdateAction::className(),
                'modelClass' => Category::className(),
                //'scenario' => 'backend',
            ],*/
            'view-layer' => [
                'class' => ViewAction::className(),
                'modelClass' => Category::className(),
            ],
            'delete' => [
                'class' => DeleteAction::className(),
                'modelClass' => Category::className(),
            ],
            'sort' => [
                'class' => SortAction::className(),
                'modelClass' => Category::className(),
            ],
            'status' => [
                'class' => StatusAction::className(),
                'modelClass' => Category::className(),
            ],
        ];
    }

    //
    public function actionCreate()
    {
        //
        $model = new Category();

        if (yii::$app->getRequest()->getIsPost()) {

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

    //动态获取子集分类内容
    public function actionChildList($type){
        //
        if(!$type) throw new InvalidParamException('type is required!');

        $tree = Tree::instance();
        $tree->init(Category::getList($type), 'parent_id');

        $options = $tree->getTreeList($tree->getTreeArray(0), 'name');
        return Html::renderSelectOptions(
            'parent_id',
            ArrayHelper::merge([0 => Yii::t('app', 'pub_please_select')], ArrayHelper::map($options, 'id', 'name'))
        );
    }

    //
    public function actionUpdate(){
        //
        if(!yii::$app->getRequest()->get('id')) throw new InvalidParamException(yii::t('app', "Id doesn't exit"));
        $model = Category::findOne(yii::$app->getRequest()->get('id'));
        if (! $model) throw new InvalidParamException(yii::t('app', "Cannot find model by "));

        //
        if (yii::$app->getRequest()->getIsPost()) {
            //页面以AJAX打开执行返回JSON格式
            Yii::$app->getResponse()->format = Response::FORMAT_JSON;
            if ($model->load(Yii::$app->getRequest()->post()) && $model->validate() && $model->save()) {
                yii::$app->getSession()->setFlash('success', yii::t('app', 'Success'));
                return $this->redirect(['index']);
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
}
