<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use common\models\Article;
use common\models\Ads;
use common\models\Projects;
use common\models\ProjectMsg;

$menu = Article::find()->select('id,title')->where(['category_id'=>13,'is_top'=>1,'is_delete'=>0,'is_push'=>1])->orderBy('order ASC')->limit(4)->asArray()->all();
$footer_menu = Article::find()->select('id,title')->where(['category_id'=>20,'is_top'=>1,'is_delete'=>0,'is_push'=>1])->orderBy('order ASC')->limit(4)->asArray()->all();
AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="index">
<?php $this->beginBody() ?>
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header page-scroll">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand page-scroll" href="/"><img src="/static/images/logo.png"></a> </div>
    
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse"  id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li> <a class="page-scroll" href="/projects/create">projects</a> </li>
        <li> <a class="page-scroll" href="/project-msg/index">leads</a> </li>
        <li> <a class="page-scroll" href="/article/faq">faq</a> </li>
        <li> <a class="page-scroll" href="/site/logout">Logout</a> </li>
      </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>
<nav class="minnavbar">
  <div class="container"> 
    <div class="navbar-header page-scroll">
      
      <span class="navbar-brand page-scroll" ><font color="red"><?php echo Projects::getUserProjectHitSum();?></font>&nbsp;&nbsp;Views</span>
      <span class="navbar-brand page-scroll" ><font color="red"><?php echo ProjectMsg::getUserProjectMsgSum();?></font>&nbsp;&nbsp;Messages</span>
      <span class="navbar-brand page-scroll" ><font color="red"><?php echo Projects::getUserProjectCount();?></font>&nbsp;&nbsp;Projects</span>
       </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav navbar-right">
        <li> <a class="page-scroll">Welcome &nbsp; <?=Yii::$app->user->identity->username?>！</a> </li>
      </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>
        <?= $content ?>
        <section id="partner">
  <div class="container">
   <!-- <div class="row">
      <div class="col-md-12">
        <div class="section-title text-center">
          <h3>Our Honorable Partner</h3>
          <p>Duis aute irure dolor in reprehenderit in voluptate</p>
        </div>
      </div>
    </div> -->
    <?php $partner_list = Ads::find()->where(['category_id'=>19,'status'=>1])->orderBy('id DESC')->asArray()->all()?>
    <?php if ($partner_list):?>
    <div class="row">
      <div class="clients">
        <?php foreach ($partner_list as $pl):?>
            <div class="col-md-12"> <img src="<?=$pl['photo']?>" class="img-responsive" alt="..." height="50"> </div>
        <?php endforeach;?>
      </div>
    </div>
    <?php endif;?>
  </div>
</section>
<section id="contact" class="contact">
  
  <footer class="style-1">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-xs-12"> <span class="copyright">Copyright C 2018 TouchIn Media Pty Ltd	<?php foreach ($footer_menu as $fm):?>|	<a href="/article/info?id=<?=$fm['id']?>" style="color:#999" title="<?=$fm['title']?>"><?=$fm['title']?></a><?php endforeach;?>	</span> </div>
        
        <div class="col-md-4 col-xs-12">
          <div class="footer-link">
            <ul class="pull-right">
              <li><a style="color:#999">Power by CampaignPROS</a> </li>
              <li><a style="color:#999">VR Partner  iStaging</a> </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </footer>
</section>
<div id="loader">
  <div class="spinner">
    <div class="dot1"></div>
    <div class="dot2"></div>
  </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
