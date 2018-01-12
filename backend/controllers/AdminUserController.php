<?php

namespace backend\controllers;

use Yii;
use backend\models\AdminUser;
use backend\models\AdminUserSearch;
use backend\models\AdminRoleUser;
use backend\widgets\ActiveForm;
use yii\web\Response;
use yii\helpers\Url;

use backend\actions\IndexAction;
use backend\actions\DeleteAction;
use backend\actions\SortAction;
use backend\actions\StatusAction;


class AdminUserController extends \yii\web\Controller
{
    //
    public function actions()
    {
        return [
            'index' => [
                'class' => IndexAction::className(),
                'data' => function(){

                    $searchModel = new AdminUserSearch();
                    $dataProvider = $searchModel->search(yii::$app->getRequest()->getQueryParams());
                    return [
                        'dataProvider' => $dataProvider,
                        'searchModel' => $searchModel,
                    ];
                }
            ],
            'delete' => [
                'class' => DeleteAction::className(),
                'modelClass' => AdminUser::className(),
            ],
            'sort' => [
                'class' => SortAction::className(),
                'modelClass' => AdminUser::className(),
            ],
            'status' => [
                'class' => StatusAction::className(),
                'modelClass' => AdminUser::className(),
            ],
        ];
    }

    //
    /**
     * 创建管理员账号
     *
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new AdminUser();
        $model->setScenario('create');
        $rolesModel = new AdminRoleUser();
        if (yii::$app->getRequest()->getIsPost()) {
            if (
                $model->load(Yii::$app->getRequest()->post())
                && $model->validate()
                && $rolesModel->load(yii::$app->getRequest()->post())
                && $rolesModel->validate()
                && $model->save()
            ) {
                $rolesModel->uid = $model->getPrimaryKey();
                $rolesModel->save();
                Yii::$app->getSession()->setFlash('success', yii::t('app', 'Success'));
                return $this->redirect(['index']);

                //Yii::$app->getResponse()->format = Response::FORMAT_JSON;
                //return ['succ' => 1];

            } else {
                $errors = $model->getErrors();
                $err = '';
                foreach ($errors as $v) {
                    $err .= $v[0] . '<br>';
                }
                if(yii::$app->getRequest()->getIsAjax()){
                    Yii::$app->getResponse()->format = Response::FORMAT_JSON;
                    return [
                        'err_msg' => $err,
                    ];
                }else{
                    Yii::$app->getSession()->setFlash('error', $err);
                }
            }
        }
        //
        $model->loadDefaultValues();
        return $this->renderAjax('create', [
            'model' => $model,
            'rolesModel' => $rolesModel,
        ]);

    }

    /*
     * 实现简单表单无需要复杂view应用场景
     * Ajax方式
    public function actionCreateForm()
    {
        $model = new AdminUser();
        $model->setScenario('create');
        $model->loadDefaultValues();
        yii::$app->getResponse()->format = Response::FORMAT_HTML;

        echo '<div id="addForm">';
        echo '    <div class="ibox-content">';
        $form = ActiveForm::begin(['action' => Url::to(['admin-user/create'])]);
        echo $form->field($model, 'username')->textInput(['maxlength' => 64]);
        echo $form->field($model, 'password')->passwordInput(['maxlength' => 512]);
        echo $form->field($model, 'email')->textInput(['maxlength' => 64]);
        //echo $form->field($model, 'wechat')->textInput(['maxlength' => 64]);
        echo $form->field($model, 'status')->radioList(AdminUser::getStatuses());
        //echo $form->field($model, 'type')->dropDownList(Constants::getEmployeeType());

        echo $form->defaultButtons();
        ActiveForm::end();
        echo '</div>';
        echo '</div>';

    }
    */

    /**
     * 修改管理员账号
     *
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionUpdate($id)
    {
        $model = AdminUser::findOne($id);
        $model->setScenario('update');
        $rolesModel = AdminRoleUser::findOne(['uid' => $id]);

        if ($rolesModel == null) {
            $rolesModel = new AdminRoleUser();
            $rolesModel->uid = $id;
        }

        if (Yii::$app->getRequest()->getIsPost()) {
            if (
                $model->load(Yii::$app->request->post())
                && $model->validate() && $rolesModel->load(yii::$app->getRequest()->post())
                && $rolesModel->validate()
                && $model->save()
                && $rolesModel->save()
            ) {
                Yii::$app->getSession()->setFlash('success', yii::t('app', 'Success'));
                //return $this->redirect(['update', 'id' => $model->getPrimaryKey()]);
                return $this->redirect(['index']);
            } else {
                $errors = $model->getErrors();
                $err = '';
                foreach ($errors as $v) {
                    $err .= $v[0] . '<br>';
                }
                //
                if(yii::$app->getRequest()->getIsAjax()){
                    Yii::$app->getResponse()->format = Response::FORMAT_JSON;
                    return [
                        'err_msg' => $err,
                    ];
                }else{
                    Yii::$app->getSession()->setFlash('error', $err);
                }
            }
            $model = AdminUser::findOne(['id' => yii::$app->getUser()->getIdentity()->getId()]);
        }

        return $this->renderAjax('update', [
            'model' => $model,
            'rolesModel' => $rolesModel,
        ]);
    }





}
