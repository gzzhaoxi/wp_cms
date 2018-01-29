<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Projects */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Projects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link href="/static/asset/css/bootstrap.min.css" rel="stylesheet">
    <script src="/static/js/jquery-2.1.1.min.js"></script>
</head>
<body>
<style>
body{padding: 0;
margin: 0;}
.img_title{
	background: #000;height:70px;text-align:right;opacity:0.6;position:absolute;width:100%;max-width:1200px;top:90px;
}
.img_title div{padding: 0 20px;line-height:70px;font-size:20px;font-weight:800;color:#fff;}
.form{
	background: #000;text-align:left;opacity:0.6;position:absolute;width:100%;max-width:1200px;bottom:20px;
}
.form .row{padding: 20px;}
.form .row .t1{font-size:40px;}
.form .row .t2{font-size:20px;}
.header{text-align: right;height:90px;line-height:90px;font-size:18px;padding:0 20px;}
.help-block{color:red;}
@media (max-width : 479px){
    .img_title{height:50px;top:50px;}
	.img_title div{line-height:50px;font-size:12px;}
	.form{position:unset;background: #eeeeee;opacity:1;}
    .form .row{padding: 10px; color:#000}
    .form .row .t1{font-size:20px;}
    .form .row .t2{font-size:14px;}
	.submit_form{padding-top:15px;}
	.header{height:50px;line-height:50px;font-size:14px;padding:0 10px;}
}

@media (max-width : 767px) and (min-width : 480px) {
    .img_title{height:50px;top:50px;}
	.img_title div{line-height:50px;font-size:12px;}
	.form{position:unset;background: #eeeeee;opacity:1;}
    .form .row{padding: 10px; color:#000}
    .form .row .t1{font-size:20px;}
    .form .row .t2{font-size:14px;}
	.submit_form{padding-top:15px;}
	.header{height:50px;line-height:50px;font-size:14px;padding:0 10px;}
}

@media (min-width : 768px) and (max-width: 991px) {
    .img_title{height:50px;top:50px;}
	.img_title div{line-height:50px;font-size:12px;}
	.form{position:unset;background: #eeeeee;opacity:1;}
    .form .row{padding: 10px; color:#000}
    .form .row .t1{font-size:20px;}
    .form .row .t2{font-size:14px;}
	.submit_form{padding-top:15px;}
	.header{height:50px;line-height:50px;font-size:14px;padding:0 10px;}
}

@media (min-width : 992px) {
	.form{bottom:unset;top:500px;}
}

</style>
<div style="width: 100%;">
        <div style="background: #eeeeee;max-width:1200px; margin:0 auto;">
                <div class="header"><?=$model->address?></div>
                <div>
                    <img alt="" src="<?=$model->photo?>" width="100%">
                    <div class="img_title">
                        <div>Open Home Inspection Registration</div>
                    </div>
                    
                    <div class="form">
                        <div style="padding: 10px 20px;color:#fff;">
                            <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                            <font class="t1">WELCOME</font><BR>
                                            <font class="t2">to my online open home inspection!</font>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 submit_form">
                                            <div class="form-group field-projects-name required">
                                            <label class="control-label" for="projects-name">Your Name</label>
                                            <input id="projects-name" class="form-control" name="name" value="" maxlength="100" aria-required="true" type="text">
                                            
                                            <div class="help-block"></div>
                                            </div>
                                            <div class="form-group field-projects-phone required">
                                            <label class="control-label" for="projects-phone">Your Phone Number</label>
                                            <input id="projects-phone" class="form-control" name="phone" value="" maxlength="30" aria-required="true" type="number">
                                            
                                            <div class="help-block"></div>
                                            </div>
                                            <div class="form-group" style="text-align:right;">
                                                    <?php if(!$model->must_input):?><a href="/projects/show?<?=$key_value?>" class="btn btn-default btn-sm">Skip</a>&nbsp;&nbsp;&nbsp;&nbsp;<?php endif;?><a href="javascript:void(0)" onclick="save_visitor()" class="btn btn-default btn-sm">Enter</a>
                                                </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

</div>
<script>
function save_visitor(){
	var key = "<?=$key_value?>";
	var name = $("#projects-name").val();
	var phone = $("#projects-phone").val();
	if(name==''){
			$(".field-projects-name > .help-block").html('Please Input Your Name');
			$("#projects-name").css("border-color","red");
			return false;
		}
	if(phone==''){
			$(".field-projects-phone > .help-block").html('Please Input Your Phone Number');
			$("#projects-phone").css("border-color","red");
			return false;
		}
	$.ajax({
  	    type: 'POST',
  	    url: '/projects/save-visitor',
  	    data: {key:key,name:name,phone:phone},
  	    beforeSend: function() {},
  	    error:function(){},
        complete:function() {},
  	    success: function(data) {
  	    	var res = $.parseJSON(data);
  	    	if(res.error==1){
					alert(res.msg);
  	  	    	}else{
  	  	  	    		window.location.href = res.info;
  	  	  	    	}
  	    },
  	  });
}
</script>
</body>
</html>