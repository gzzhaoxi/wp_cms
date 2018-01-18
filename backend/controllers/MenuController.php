<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2017-03-15 21:16
 */

namespace backend\controllers;

use yii;
use backend\models\Menu;
use backend\models\MenuSearch;

use backend\widgets\ActiveForm;
use yii\web\Response;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\libs\Constants;

use backend\actions\CreateAction;
use backend\actions\UpdateAction;
use backend\actions\IndexAction;
use backend\actions\DeleteAction;
use backend\actions\SortAction;
use backend\actions\StatusAction;

/**
 * Menu controller
 */
class MenuController extends \yii\web\Controller
{

    public function actions()
    {
        return [
            'index' => [
                'class' => IndexAction::className(),
                'data' => function(){
                    //Yii::$app->params['pageSize'] = 5;
                    $searchModel = new MenuSearch(['scenario' => 'backend']);
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
                'modelClass' => Menu::className(),
                'scenario' => 'backend',
            ],
            'update' => [
                'class' => UpdateAction::className(),
                'modelClass' => Menu::className(),
                'scenario' => 'backend',
            ],
            'delete' => [
                'class' => DeleteAction::className(),
                'modelClass' => Menu::className(),
            ],
            'sort' => [
                'class' => SortAction::className(),
                'modelClass' => Menu::className(),
            ],
            'status' => [
                'class' => StatusAction::className(),
                'modelClass' => Menu::className(),
            ],
        ];
    }

    //
    public function actionCreateForm()
    {
        $model = new Menu();
        //$model->setScenario('create');

        $parent_id = yii::$app->getRequest()->get('parent_id', '');
        if ($parent_id != '') {
            $model->parent_id = $parent_id;
        }

        $model->loadDefaultValues();
        yii::$app->getResponse()->format = Response::FORMAT_HTML;

        echo '<div id="addForm">';
        echo '    <div class="ibox-content">';

        $form = ActiveForm::begin(['action' => Url::to(['menu/create'])]);
        echo $form->field($model, 'parent_id')->dropDownList(Menu::getMenusName(Menu::BACKEND_TYPE));
        echo $form->field($model, 'name')->textInput(['maxlength' => 64]);
        //echo $form->field($model, 'is_absolute_url')->radioList(Constants::getYesNoItems());
        echo $form->field($model, 'url')->textInput(['maxlength' => 512]);
        echo $form->field($model, 'method')->dropDownList(Constants::getHttpMethodItems());
        echo $form->field($model, 'icon')->textInput(['maxlength' => 64]);
        echo $form->field($model, 'sort')->textInput(['maxlength' => 64]);
        echo $form->field($model, 'is_display')->radioList(Constants::getYesNoItems());

        echo $form->defaultButtons();
        ActiveForm::end();

        echo '    </div>';
        echo '</div>';

    }

    //
    public static function actionLoadMenu($type){
        $rs = [];
        $rs = Menu::getMenusName($type);
        return Html::renderSelectOptions(
            'parent_id',
            ArrayHelper::merge([0 => Yii::t('app', 'pub_please_select')], $rs)
        );
    }

}
