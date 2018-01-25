<?php
use yii\Helpers\Url;
use backend\widgets\ActiveForm;
use common\libs\Constants;
use common\widgets\JsBlock;

$message_count = \common\models\ProjectMsg::find()->where(['user_id'=>$model->user_id,'project_id'=>$model->id])->count();

?>
<style>
    .edui-faked-video{}


</style>
<div id="addForm">
    <div class="ibox-content">
        <?php $form = ActiveForm::begin(); ?>

        <?=$form->field($model, 'name')->textInput(['maxlength' => true,'readonly'=>'readonly'])?>
        <?=$form->field($model, 'office_name')->textInput(['readonly'=>'readonly'])?>
        <?=$form->field($model, 'address')->textarea(['readonly'=>'readonly'])?>
        <?=$form->field($model, 'hit')->textInput(['readonly'=>'readonly'])?>
        <div id="message">
            <div class="form-group fb plan-item" style="">
                <label style="" class="col-lg-2 control-label" for="order-customer_id">Message Num:</label>
                <div class="col-sm-8 col-xs-12">
                    <div >
                        <input  type="text" id="projects-hit" class="form-control" name="Projects[hit]" value="<?=$message_count ?>" readonly="readonly" aria-invalid="false">
                    </div>
                </div>
            </div>


        </div>

        <?=$form->field($model, 'link')->textInput(['readonly'=>'readonly'])?>
        <?=$form->field($model, 'msg')->textarea(['readonly'=>'readonly'])?>
        <div id="photo">
            <div class="form-group fb plan-item" style="">
                <label style="position:relative;top:40px" class="col-lg-2 control-label" for="order-customer_id">Photo:</label>
                <div class="col-sm-8 col-xs-12">
                    <div >
                        <img src="<?=$model->photo ?>"  style="width:100px;height:100px">
                    </div>
                </div>
            </div>


        </div>

        <div class="form-group">
            <div class="col-sm-4 col-sm-offset-2">
                <a class="btn btn-primary" href="/project"><?=Yii::t('app','pub_back') ?></a>
            </div>
        </div>
        <?php ActiveForm::end();?>
    </div>
</div>
<?php JsBlock::begin() ?>
<script>

    function loadChildList(type){
        $.get('<?=Url::to(['child-list', 'type' => ''])?>'+type, function(data){
            $('select#category-parent_id').html(data);
        });
    }

    $('#user-password').val('')
</script>
<?php JsBlock::end();?>
