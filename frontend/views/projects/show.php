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

.form{
	background: #eeeeee;text-align:left;width:100%;max-width:1200px;bottom:20px;
}
.form .row{padding: 20px;color:#000;}
.form .row .t1{font-size:40px;}
.form .row .t2{font-size:20px;}
.header{text-align: right;height:90px;line-height:90px;font-size:18px;padding:0 20px;}
.header a{font-size:16px;}
.help-block{color:red;}
@media (max-width : 479px){
	.submit_form{padding-top:15px;}
	.header{height:50px;line-height:50px;font-size:14px;padding:0 10px;}
}

@media (max-width : 767px) and (min-width : 480px) {
	.submit_form{padding-top:15px;}
	.header{height:50px;line-height:50px;font-size:14px;padding:0 10px;}
}

@media (min-width : 768px) and (max-width: 991px) {
	.submit_form{padding-top:15px;}
	.header{height:50px;line-height:50px;font-size:14px;padding:0 10px;}
}

@media (min-width : 992px) {
	.form{bottom:unset;top:500px;}
}

</style>
<div style="width: 100%;">
        <div style="background: #eeeeee;max-width:1200px; margin:0 auto;">
                <div class="header"><div style="float:left;"><?=$model->address?></div><div style="float:right;"><a href="<?=$model->link ?>" target="_blank">View Full Size In VR</a></div></div>
                <div>
                    <iframe src="<?=$model->link ?>" width="100%" height="600" style="border:0;" allowfullscreen="true"></iframe>
                    <div class="row" id="notice" style="display:none;margin:0px;"><div class="alert alert-success" role="alert">Well done! You successfully submit your message. </div></div>
                    <div class="form">
                        <div style="padding: 10px 20px;color:#fff;">
                            <div class="row">
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
                                            
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group field-projects-msg">
                                                <label class="control-label" for="projects-msg">Your Message</label>
                                                <textarea id="projects-msg" class="form-control" name="message" rows="6"></textarea>
                                                
                                                <div class="help-block"></div>
                                            </div>
                                            <div class="form-group" style="text-align:right;">
                                                    <a href="javascript:void(0)" onclick="save_msg()" class="btn btn-primary btn-sm">Send</a>
                                                </div>
                                    </div>
                                    
                            </div>
                        </div>
                    </div>
                </div>
        </div>

</div>
<script>
function save_msg(){
	var key = "<?=$key_value?>";
	var name = $("#projects-name").val();
	var phone = $("#projects-phone").val();
	var msg = $("#projects-msg").val();
	if(name==''){
			$(".field-projects-name > .help-block").html('Please Input Your Name');
			$("#projects-name").css("border-color","red");
			return false;
		}else{
				$(".field-projects-name > .help-block").html('');
				$("#projects-name").css("border-color","green");
			}
	if(phone==''){
			$(".field-projects-phone > .help-block").html('Please Input Your Phone Number');
			$("#projects-phone").css("border-color","red");
			return false;
		}else{
				$(".field-projects-phone > .help-block").html('');
                $("#projects-phone").css("border-color","green");
			}
	if(msg==''){
			$(".field-projects-msg > .help-block").html('Please Input Your Message');
			$("#projects-msg").css("border-color","red");
			return false;
		}else{
    			$(".field-projects-msg > .help-block").html('');
    			$("#projects-msg").css("border-color","green");
			}
	$.ajax({
  	    type: 'POST',
  	    url: '/projects/save-msg',
  	    data: {key:key,name:name,phone:phone,msg:msg},
  	    beforeSend: function() {},
  	    error:function(){},
        complete:function() {},
  	    success: function(data) {
  	    	var res = $.parseJSON(data);
  	    	if(res.error==1){
					alert(res.msg);
  	  	    	}else{
      	  	  	    	$("#projects-name").css("border-color","#ccc");
      	  	  	    	$("#projects-phone").css("border-color","#ccc");
      	  	  	    	$("#projects-msg").css("border-color","#ccc");
      	  	  	    	$("#projects-name").val("");
      	  	  	    	$("#projects-phone").val("");
      	  	  	    	$("#projects-msg").val("");
      	  	  	    	$("#notice").show();
  	  	  	    	}
  	    },
  	  });
}
</script>
</body>
</html>