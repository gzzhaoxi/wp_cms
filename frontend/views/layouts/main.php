<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

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
      <a class="navbar-brand page-scroll" href="#page-top"><img src="/static/images/logo.png"></a> </div>
    
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav navbar-right">
        <li> <a class="page-scroll" href="#">Register</a> </li>
        <li> <a class="page-scroll" href="#">Login</a> </li>
      </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>
<nav class="minnavbar">
  <div class="container"> 
    
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li> <a class="page-scroll" href="#">iWalkthrough Content Marketing Solution</a> </li>
        <li> <a class="page-scroll" href="#">DIY Video Production</a> </li>
        <li> <a class="page-scroll" href="#">DIY Virtual Realisty Production</a> </li>
        <li> <a class="page-scroll" href="#">Price & Plans</a> </li>
      </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>
        <?= $content ?>
        <section id="partner">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="section-title text-center">
          <h3>Our Honorable Partner</h3>
          <p>Duis aute irure dolor in reprehenderit in voluptate</p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="clients">
        <div class="col-md-12"> <img src="/static/images/logos/themeforest.jpg" class="img-responsive" alt="..."> </div>
        <div class="col-md-12"> <img src="/static/images/logos/creative-market.jpg" class="img-responsive" alt="..."> </div>
        <div class="col-md-12"> <img src="/static/images/logos/designmodo.jpg" class="img-responsive" alt="..."> </div>
        <div class="col-md-12"> <img src="/static/images/logos/creative-market.jpg" class="img-responsive" alt="..."> </div>
        <div class="col-md-12"> <img src="/static/images/logos/microlancer.jpg" class="img-responsive" alt="..."> </div>
        <div class="col-md-12"> <img src="/static/images/logos/themeforest.jpg" class="img-responsive" alt="..."> </div>
        <div class="col-md-12"> <img src="/static/images/logos/microlancer.jpg" class="img-responsive" alt="..."> </div>
        <div class="col-md-12"> <img src="/static/images/logos/designmodo.jpg" class="img-responsive" alt="..."> </div>
        <div class="col-md-12"> <img src="/static/images/logos/creative-market.jpg" class="img-responsive" alt="..."> </div>
        <div class="col-md-12"> <img src="/static/images/logos/designmodo.jpg" class="img-responsive" alt="..."> </div>
      </div>
    </div>
  </div>
</section>
<section id="contact" class="contact">
  
  <footer class="style-1">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-xs-12"> <span class="copyright">Copyright C 2018 TouchIn Media Pty Ltd	|	Privacy Policy	|	Terms of Use	|	Contct Us	|	About Us	</span> </div>
        
        <div class="col-md-4 col-xs-12">
          <div class="footer-link">
            <ul class="pull-right">
              <li><a href="#">Power by CampaignPROS</a> </li>
              <li><a href="#">VR Partner  iStaging</a> </li>
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
