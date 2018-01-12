<?php

/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2017-08-13 00:06
 */
namespace backend\actions;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\base\Action;

class CreateAction extends \yii\base\Action
{

    public $modelClass;

    public $scenario = 'default';

    public $data = [];


    /**
     * create创建页
     *
     * @return string|\yii\web\Response
     */
    public function run()
    {
        /* @var $model yii\db\ActiveRecord */
        $model = new $this->modelClass;
        $model->setScenario( $this->scenario );

        if(yii::$app->getRequest()->getIsAjax()){
            //
            if (yii::$app->getRequest()->getIsPost()) {
                Yii::$app->getResponse()->format = Response::FORMAT_JSON;
                if ($model->load(yii::$app->getRequest()->post()) && $model->save()) {
                    Yii::$app->getSession()->setFlash('success', yii::t('app', 'Success'));
                    //
                    return $this->controller->redirect(['index']);
                } else {
                    $errors = $model->getErrors();

                    $err = '';
                    foreach ($errors as $v) {
                        $err .= $v[0] . '<br>';
                    }
                    //yii::$app->getResponse()->format = Response::FORMAT_JSON;
                    return [
                        'err_msg' => $err,
                    ];
                }
            }
            $model->loadDefaultValues();
            $data = array_merge(['model' => $model], $this->data);
            return $this->controller->renderAjax('create', $data);

        }else {

            if (yii::$app->getRequest()->getIsPost()) {
                if ($model->load(yii::$app->getRequest()->post()) && $model->validate() && $model->save()) {
                    yii::$app->getSession()->setFlash('success', yii::t('app', 'Success'));
                    return $this->controller->redirect(['index']);
                } else {
                    $errors = $model->getErrors();
                    $err = '';
                    foreach ($errors as $v) {
                        $err .= $v[0] . '<br>';
                    }
                    Yii::$app->getSession()->setFlash('error', $err);
                }
            }
            $model->loadDefaultValues();
            $data = array_merge(['model' => $model], $this->data);
            return $this->controller->render('create', $data);
        }
    }

}