<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\Projects;
use common\models\ProjectMsg;

/**
 * Site controller
 */
class UserController extends Controller
{
    public  $layout = 'user';
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'change-password'],
                'rules' => [
                    [
                        'actions' => ['index', 'change-password'],
                        'allow' => true,         //允许用户登出、修改密码
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
            ],
        ];
    }
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $user_id = Yii::$app->user->id;
        $views_total = Projects::getUserProjectHitSum();
        $project_total = Projects::getUserProjectCount();
        $msg_total = ProjectMsg::getUserProjectMsgSum();
        return $this->render('index',['views'=>$views_total,'project'=>$project_total,'messages'=>$msg_total]);
    }
}