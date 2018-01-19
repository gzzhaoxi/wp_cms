<?php
use yii\Helpers\Url;
use backend\widgets\ActiveForm;
use common\libs\Constants;
use common\widgets\JsBlock;
if(!empty($model->detail)){
    $detail = json_decode($model->detail,true);
    array_multisort(array_column($detail, 'sort'), $detail);
}else{
    $detail = [];
}


?>
<style>
    .edui-faked-video{}
</style>
<div id="addForm">
    <div class="ibox-content">
        <?php $form = ActiveForm::begin(); ?>

        <?=$form->field($model, 'title')->textInput(['maxlength' => true])?>
        <?=$form->field($model, 'subhead')->textInput(['maxlength' => true])?>
        <?=$form->field($model, 'price')->textInput(['maxlength' => true])?>
        <?=$form->field($model, 'link')->textInput()?>

        <div class="form-group">
            <label class="col-lg-2 control-label" for="order-customer_id"><?=Yii::t('app','pub_detail') ?></label>
            <div class="col-md-10 droppable sortable ui-droppable ui-sortable" style="">
                <?=
                \yii\helpers\Html::a("<i class='fa fa-list-alt'></i>". Yii::t('app','pub_add_detail') , 'javascript:;', [
                    'title' => Yii::t('app','pub_add_detail'),
                    'data-pjax' => '0',
                    'class' => 'btn btn-info btn-add',
                    'onClick' => "onAddDetail($(this))",
                ])
                ?>
            </div>
        </div>
        <div id="detail">
            <div class="form-group fb plan-item" style="display:none">
                <label class="col-lg-2 control-label" for="order-customer_id"></label>
                <div class="col-sm-8 col-xs-12">
                    <div >

                        条目：<input type="text"  class="form-control" name="detail[val][]" aria-invalid="false" style="display: inline-block;width:50%">
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        排序：<input type="text"  class="form-control" name="detail[sort][]" aria-invalid="false" style="display: inline-block;width:10%">
                        &nbsp; &nbsp; &nbsp;
                        <i  style="font-size:15px;color:red;cursor: pointer" onclick="deleteImg(this)" class="glyphicon glyphicon-trash" aria-hidden="true"></i>
                    </div>
                </div>
            </div>

            <?php foreach($detail as $k=>$v){ ?>
                <div class="form-group  plan-item" style="">
                    <label class="col-lg-2 control-label" for="order-customer_id"></label>
                    <div class="col-sm-8 col-xs-12">
                        <div >

                            条目：<input type="text"  class="form-control" value="<?=$v['val'] ?>" name="detail[val][]" aria-invalid="false" style="display: inline-block;width:50%">
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            排序：<input type="text"  class="form-control" value="<?=$v['sort'] ?>" name="detail[sort][]" aria-invalid="false" style="display: inline-block;width:10%">
                            &nbsp; &nbsp; &nbsp;
                            <i  style="font-size:15px;color:red;cursor: pointer" onclick="deleteImg(this)" class="glyphicon glyphicon-trash" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            <?php  } ?>

        </div>

        <?=$form->field($model, 'status')->radioList(Constants::getYesNoItems(),['style'=>'position:relative;top:-6px'])?>
        <?=$form->defaultButtons()?>
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

    function onAddDetail(obj){
        var html = $('.fb').clone();
        html.removeClass('fb');

        $("#detail").append(html);
        html.show();

    }

    function deleteImg(obj){
        $(obj).parent().parent().parent().remove();
    }

</script>
<?php JsBlock::end();?>
