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
use common\models\Article;

/**
 * Site controller
 */
class ArticleController extends Controller
{

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionInfo($id)
    {
        $info = Article::find()->where(['id'=>$id])->asArray()->one();
        return $this->render('info',['info'=>$info]);
    }
    
    public function actionFaq() {
        $this->layout = 'user';
        $list = Article::find()->select('title,content')->where(['category_id'=>21,'is_push'=>1,'is_delete'=>0])->orderBy('is_top DESC,order ASC')->asArray()->all();
        return $this->render('faq',['list'=>$list]);
    }

}
