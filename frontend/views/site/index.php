<?php
use common\models\Article;
use common\models\Plan;
use common\models\Ads;
/* @var $this yii\web\View */

$this->title = 'Home Page';
?>
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
            <div class="item active"> <a href="<?=$b['link']?>"><img class="img-responsive" src="<?=$b['photo']?>" alt="slider"></a>
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
<section id="feature" class="feature-section">
  <div class="container">
    <div class="row">
      <?php $list1 = Article::find()->select('id,title,desc,photo')->where(['category_id'=>14,'is_top'=>1,'is_push'=>1,'is_delete'=>0])->orderBy('order ASC')->limit(6)->asArray()->all()?>
      <!-- /.col-md-3 -->
      <?php foreach ($list1 as $l):?>
      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="feature"> <img alt="<?=$l['title']?>" src="<?=$l['photo']?>" width=50/>
          <div class="feature-content">
            <h4><?=$l['title']?></h4>
            <p><?=$l['desc']?></p>
            <a href="/article/info?id=<?=$l['id']?>" style="color:red">DETAILS</a>
          </div>
        </div>
      </div>
      <?php endforeach;?>
    </div>
    
  </div>
  <!-- /.container --> 
</section>
<div class="about-us-section-2">
  <div class="container">
  <?php $page = Article::find()->select('id,title,desc,photo')->where(['category_id'=>17,'is_top'=>1,'is_push'=>1,'is_delete'=>0])->orderBy('order ASC')->asArray()->one()?>
    <div class="row">
	<div class="col-md-6">
        <div id="carousel-example-generic" class="carousel slide about-slide" data-ride="carousel"> 
          <!-- Wrapper for slides -->
          <div class="carousel-inner">
            <div class="item active"> <img src="<?=$page['photo']?>" alt="<?=$page['title']?>" width="500"> </div>
            
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="skill-shortcode"> 
     		<div class="section-title text-center">
                  <h3><?=$page['title']?></h3>
                  <p><?=$page['desc']?></p>
                  <a class="btn btn-primary" href="/article/info?id=<?=$page['id']?>">More</a>
            </div>          
        </div>
      </div>
      
    </div>
  </div>
</div>
<div id="pricing" class="pricing-section">
  <div class="container">
  <?php $plan_list = Plan::find()->where(['status'=>1])->orderBy('sort ASC')->asArray()->all()?>
  
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-12">
          <div class="section-title text-center">
            <h3>Our Pricing Plan</h3>
            <p class="white-text">Duis aute irure dolor in reprehenderit in voluptate</p>
          </div>
        </div>
      </div>
    </div>
    
    <div class="row">
      <div class="pricing">
      <?php if ($plan_list):?>
        <?php foreach ($plan_list as $pl):?>
        <div class="col-md-12">
          <div class="pricing-table">
            <div class="plan-name">
              <h3><?=$pl['title']?></h3>
            </div>
            <div class="plan-price">
              <div class="price-value">$<?=number_format($pl['price'],0)?><span>.00</span></div>
              <div class="interval">per month</div>
            </div>
            <?php $detail = json_decode($pl['detail'],true);?>
            <?php if ($detail):?>
            <div class="plan-list">
              <ul>
              <?php foreach ($detail as $dl):?>
                <li><?=$dl['val']?></li>
                <?php endforeach;?>
              </ul>
            </div>
            <?php endif;?>
            <div class="plan-signup"> <a href="<?=$pl['link']?>" class="btn-system btn-small">Get Started</a> </div>
          </div>
        </div>
        <?php endforeach;?>
        <?php endif;?>
      </div>
    </div>
  </div>
</div>
<section id="feature" class="feature-two-section">
  <div class="container">
  
    <div class="row">
      <?php $list2 = Article::find()->select('id,title,desc,photo')->where(['category_id'=>18,'is_top'=>1,'is_push'=>1,'is_delete'=>0])->orderBy('order ASC')->limit(6)->asArray()->all()?>
      <!-- /.col-md-3 -->
      <?php foreach ($list2 as $l):?>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="feature"> <img alt="<?=$l['title']?>" src="<?=$l['photo']?>" width=50/>
          <div class="feature-content">
            <h4><?=$l['title']?></h4>
            <p><?=$l['desc']?></p>
          </div>
        </div>
      </div>
      <?php endforeach;?>
      
    </div>
    
    <!-- /.row --> 
    
  </div>
  <!-- /.container --> 
</section>
