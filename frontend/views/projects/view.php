<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Article;

/* @var $this yii\web\View */
/* @var $model common\models\Projects */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Projects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
.pricing-section{padding:0px;}
.form-group{
	text-align:left;
}
label{line-height:30px;}
</style>
<div id="pricing" class="pricing-section">
  <div class="container">
  
    <div class="row">
    <a class="btn btn-success" href="/projects/update?id=<?=$model->id?>" role="button">Update</a>&nbsp;<a class="btn btn-success" href="/projects/show?<?=$key_value?>" role="button">Preview</a>&nbsp;<a class="btn btn-success" href="javascript:void(0)" role="button">Share</a>
    </div>
    <div class="row">
<div class="projects-view">
<div class="row">
      <!-- /.col-md-3 -->
      <div class="col-md-8 col-sm-8 col-xs-12">
      <div class="feature" style="padding: 15px;">
    <div class="form-group field-projects-name required">
<label class="control-label" for="projects-name">Your Customised Online Open Home Inspection Link:</label>
<input id="projects-name" class="form-control" name="link" maxlength="255" type="text" value="<?=$url?>"  onfocus="this.select()" readonly="readonly" style="width:80%;float:left;">
<button type="button" class="btn btn-primary btn-sm" style="float:right;" onclick="copy()">copy</button>
<div class="help-block" style="clear:both;"></div>
</div>
<div class="form-group field-projects-must_input" style="clear: both; ">
        <!-- <b>Submit to realestate.com.au</b>
        <br/>
        1&nbsp; Creating a LiveTour with Rotator + 720° Lens<br/>
        &nbsp;&nbsp;Step 1:Capturing panoramas 1.Download the VR Maker app on Google Play or the App Store and log in with<br>
        
        Vistor Information not Required
        Vistot Information Required
     -->
     <?php $list1 = Article::find()->select('content')->where(['id'=>34])->asArray()->one();
            if ($list1){
                echo $list1['content'];
            }
     ?>
     
     <br>
     <br>
     <b>Share to Your Social Media Network</b><br><br>
     <!-- JiaThis Button BEGIN -->
<div class="jiathis_style_32x32">
<a class="jiathis_button_fb"></a>
<a class="jiathis_button_twitter"></a>
<a class="jiathis_button_linkedin"></a>
<a class="jiathis_button_googleplus"></a>
<a class="jiathis_button_weixin"></a>
<a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jiathis_separator jtico jtico_jiathis" target="_blank"></a>
<a class="jiathis_counter_style"></a>
</div>
<script type="text/javascript" >
var jiathis_config={
		url:"<?=$url?>",
	    title:"<?=$model->name?>",
	    summary:"<?=$model->msg?>",
	    pic:"<?=$model->photo?>",
	shortUrl:false,
	hideMore:false
}
</script>
<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
<!-- JiaThis Button END -->
     
    </div>

</div>
</div>
      <div class="col-md-4 col-sm-4 col-xs-12">
        <?php  echo $this->render('right_ad'); ?>
      </div>
      </div>
</div>
</div>
</div>
</div>
<script>
function copy(){
	clipboard.writeText("<?=$url?>");
	$(".field-projects-name > .help-block").html('Copy Success');
}
</script>
