<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\widgets\JsBlock;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = yii::t('app', 'page_title_login');
?>

<style type="text/css">

    .login-page{
        background: url("<?=Yii::$app->params['admin']['url']?>static/images/bg-pattern.png") repeat scroll 0 0%, rgba(0, 0, 0, 0) linear-gradient(to left, #328944, #247cdc) repeat scroll 0 0;
        color: white;
        min-height: auto;
        overflow-y: hidden;
        position: relative;
        width: 100%;
    }
    .login-panel{margin-top:150px;}
    .login-screen {
        max-width:400px;
        padding:0;
        margin:100px auto 0 auto;

    }
    .login-screen .well {
        border-radius: 10px;
        -webkit-box-shadow: 0 0 10px rgba(105, 105, 105, 0.7);
        box-shadow: 0 0 10px rgba(105, 105, 105, 0.7);
        background: rgba(47, 79, 79, 0.5);
        border: 0.75px solid #f5f5f5;
        padding: 20px;
    }
    .login-screen .copyright {
        text-align: center;
    }
    @media(max-width:767px) {
        .login-screen {
            padding:0 20px;
        }
    }
    .profile-img-card {
        width: 100px;
        height: 100px;
        margin: 10px auto;
        display: block;
        -moz-border-radius: 50%;
        -webkit-border-radius: 50%;
        border-radius: 50%;
    }
    .profile-name-card {
        text-align: center;
    }

    #login-form {
        margin-top:20px;
    }
    #login-form .input-group {
        margin-bottom:15px;
    }
    /* .btn {
         text-transform: uppercase;
         letter-spacing: 2px;
         border-radius: 300px;
         display: inline-block;
         padding: 6px 12px;
         margin-bottom: 0;
         font-size: 14px;
         font-weight: 400;
         line-height: 1.42857143;
         text-align: center;
         white-space: nowrap;
         vertical-align: middle;
         -ms-touch-action: manipulation;
         touch-action: manipulation;
         cursor: pointer;
         background-color: #fdcc52;

     }
     .btn-outline {
         color: white;
         border-color: white;
         border: 1px solid;
     }
     */
</style>

<div class="container">
    <div class="login-wrapper">
        <div class="login-screen">
            <div class="well">
                <div class="login-form">
                    <img id="profile-img" class="profile-img-card" src="<?=Yii::$app->params['admin']['url']?>static/images/avatar.png" />
                    <p id="profile-name" class="profile-name-card"></p>
                    <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>
                    <?=
                    $form->field($model, 'username', ['template' => "<div class=\"input-group\"><div class=\"input-group-addon\"><span class=\"glyphicon glyphicon-user\" aria-hidden=\"true\"></span></div>{input}</div>"])
                        ->textInput(['class' => 'form-control', 'placeholder' => yii::t('app', 'form_placeholder_name')])
                    ?>

                    <?=
                    $form->field($model, 'password', ['template' => "<div class=\"input-group\"><div class=\"input-group-addon\"><span class=\"glyphicon glyphicon-lock\" aria-hidden=\"true\"></span></div>{input}</div>"])
                        ->passwordInput(['class' => 'form-control', 'placeholder' => yii::t('app', 'form_placeholder_pwd')])
                    ?>




                    <div class="form-group">
                        <label class="inline" for="keeplogin" style="font-weight: 200">
                            <input type="checkbox" name="keeplogin" id="keeplogin" value="1" />
                            <?php echo Yii::t('app', 'form_keep_active');?>
                        </label>
                    </div>

                    <?=
                    Html::submitButton(Yii::t('app', 'btn_login'), [
                        'class' => 'btn btn-success btn-lg btn-block',
                        //'class' => 'btn btn-lg btn-block btn-outline',
                        'id' => 'btn_login'
                    ])
                    ?>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
            <p class="copyright"><?=yii::t('app', 'site_copy_right')?></p>
        </div>
    </div>
</div>
