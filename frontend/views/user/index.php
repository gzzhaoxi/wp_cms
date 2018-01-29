<?php
use common\models\Article;
use common\models\Plan;
use common\models\Ads;
/* @var $this yii\web\View */

$this->title = 'Home Page';
?>
<style>
<!--
.carousel-control{display:none;}
.circle {
        height: 150px;
        width: 150px;
        display: inline-block;
	       line-height:150px;
        text-align: center;
        vertical-align: middle;
        border-radius: 50%;
        background: #65a2be;
	   color:#fff;
	font-size:20px;
	   
    }
-->
</style>
<?php $banner = Ads::find()->where(['category_id'=>16,'status'=>1])->orderBy('id DESC')->asArray()->all()?>
    <?php if ($banner):?>
<section id="page-top"> 
  <!-- Carousel -->
  <div id="main-slide" class="carousel slide" data-ride="carousel"> 
    
    <!-- Indicators -->
    <!--<ol class="carousel-indicators">
      <li data-target="#main-slide" data-slide-to="0" class="active"></li>
       <li data-target="#main-slide" data-slide-to="1"></li>
      <li data-target="#main-slide" data-slide-to="2"></li> 
    </ol>-->
    <!--/ Indicators end--> 
    
    <!-- Carousel inner -->
    <div class="carousel-inner">
        <?php foreach ($banner as $b):?>
            <div class="item active"> <img class="img-responsive" src="<?=$b['photo']?>" alt="slider">
             <div class="slider-content">
             <div class="container">
                        <div class="col-md-4 col-sm-6 col-xs-12 text-center">
                            <div class="circle" style="align-content: center">
                            <span class="intro-font"><?=$views?></span><br>
                            </div>
                            <div class="row" style="color: #000;line-height:30px;">Views</div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12 text-center">
                            <div class="circle" style="align-content: center">
                            <span class="intro-font"><?=$messages?></span><br>
                            </div>
                            <div class="row" style="color: #000;line-height:30px;">Messages</div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12 text-center">
                            <div class="circle" style="align-content: center">
                            <span class="intro-font"><?=$project?></span><br>
                            </div>
                            <div class="row" style="color: #000;line-height:30px;">Projects</div>
                        </div>
                        </div>
                    </div>
                            
                        </div>
                    </div>
        <?php endforeach;?>
      </div>
      <!--/ Carousel item end --> 
    </div>
    <!-- Carousel inner end--> 
    
    <!-- Controls --> 
    <a class="left carousel-control" href="#main-slide" data-slide="prev"> <span><i class="fa fa-angle-left"></i></span> </a> <a class="right carousel-control" href="#main-slide" data-slide="next"> <span><i class="fa fa-angle-right"></i></span> </a> </div>
  <!-- /carousel --> 
</section>
<?php endif;?>
<section id="feature" class="feature-section user-feature">
  <div class="container">
    <div class="row">
      <!-- /.col-md-3 -->
      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="feature">
            <div class="circle" style="align-content: center">
                            <span class="intro-font"><?=$views?></span><br>
                            </div>
                            <div class="row" style="color: #000;line-height:30px;">Views</div>
        </div>
      </div>
      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="feature">
            <div class="circle" style="align-content: center">
                            <span class="intro-font"><?=$messages?></span><br>
                            </div>
                            <div class="row" style="color: #000;line-height:30px;">Messages</div>
        </div>
      </div>
      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="feature">
            <div class="circle" style="align-content: center">
                            <span class="intro-font"><?=$project?></span><br>
                            </div>
                            <div class="row" style="color: #000;line-height:30px;">Projects</div>
        </div>
      </div>
    </div>
    
  </div>
  <!-- /.container --> 
</section>