<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Projects */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
.pricing-section{padding:0px;}
.form-group{
	text-align:left;
}
label{line-height:30px;}
.radio label, .checkbox label{line-height:20px;}
</style>
<div class="projects-form">
<div class="row">
      <!-- /.col-md-3 -->
      <div class="col-md-8 col-sm-8 col-xs-12">
        <div class="feature" style="padding: 15px;">
            <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'office_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'msg')->textarea(['rows' => 6]) ?>

    <div class="form-group field-projects-photo">
        <label class="control-label" for="projects-photo">Intro Image</label>
        <input name="Projects[photo]" id="projects_photo" value="<?=$model->photo?>" type="hidden">
        <input id="projects-photo" name="images" type="file" onchange="upload()">
        <div class="help-block"><?php echo $model->photo ? '<img src="'.$model->photo.'" width="100">' : ''?></div>
    </div>

    <div class="form-group field-projects-must_input">
    <label class="control-label" for="projects-must_input">Visitor Registration Options</label>
    <div class="radio">
      <label>
        <input type="radio" name="Projects[must_input]" id="optionsRadios1" value="0" checked>
        Vistor Information not Required
      </label>
    </div>
    <div class="radio">
      <label>
        <input type="radio" name="Projects[must_input]" id="optionsRadios2" value="1">
        Vistot Information Required
      </label>
    </div>
    
    <div class="help-block"></div>
    </div>
    <div class="form-group" style="text-align:right;">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Next') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
        </div>
      </div>
      <div class="col-md-4 col-sm-4 col-xs-12">
        <?php  echo $this->render('right_ad'); ?>
      </div>
    </div>
</div>
<script>
function upload(){
	var formData = new FormData();
	formData.append("file", document.getElementById("projects-photo").files[0]);
	formData.append("name", '');  
    $.ajax({  
         url: '/projects/upload' ,  
         type: 'POST',  
         data: formData,  
         async: false,  
         cache: false,  
         contentType: false,  
         processData: false,
         success: function (returndata) {  
        	 var res = $.parseJSON(returndata);
        	 if(res.error == 0){
             	$(".field-projects-photo > .help-block").html('<img src="'+res.info+'" width="100">');
             	$("#projects_photo").val(res.info);
        	 }else{
        		 	$(".field-projects-photo > .help-block").html(res.msg);
            	 }
         },  
         error: function (returndata) {  
         }  
    });
}
</script>