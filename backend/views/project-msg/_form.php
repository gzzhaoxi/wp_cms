<?php
use yii\Helpers\Url;
use backend\widgets\ActiveForm;
use common\libs\Constants;
use common\widgets\JsBlock;

$project_info = \backend\models\Projects::find()->where(['id'=>$model->project_id])->asArray()->one();

?>
<style>
    .edui-faked-video{}


</style>
<div id="addForm" style="margin-top:50px">
    <div class="ibox-content">
        <?php $form = ActiveForm::begin(); ?>


        <div id="name">
            <div class="form-group fb plan-item" style="">
                <label style="" class="col-lg-2 control-label" for="order-customer_id"><?=Yii::t('project','project_name') ?>:</label>
                <div class="col-sm-8 col-xs-12">
                    <div >
                        <input type="text" id="projects-hit" class="form-control" name="Projects[hit]" value="<?=$project_info['name'] ?>" readonly="readonly" aria-invalid="false">
                    </div>
                </div>
            </div>


        </div>
        <?=$form->field($model, 'name')->textInput(['maxlength' => true,'readonly'=>'readonly'])?>
        <?=$form->field($model, 'tel')->textInput(['readonly'=>'readonly'])?>
        <?=$form->field($model, 'email')->textInput(['readonly'=>'readonly'])?>
        <?=$form->field($model, 'msg')->textarea(['readonly'=>'readonly'])?>


       <!-- <div class="form-group">
            <div class="col-sm-4 col-sm-offset-2">
                <a class="btn btn-primary" href="/project"><?=Yii::t('app','pub_back') ?></a>
            </div>
        </div>-->
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
