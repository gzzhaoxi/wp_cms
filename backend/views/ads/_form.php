<?php
use yii\Helpers\Url;
use backend\widgets\ActiveForm;
use common\libs\Constants;
use common\widgets\JsBlock;

\common\widgets\ueditor\assets\UeditorAsset::register($this);
?>
<style>
    .edui-faked-video{}
    #image-list img{margin-right:10px}
</style>
<div id="addForm">
    <div class="ibox-content">
        <?php $form = ActiveForm::begin(); ?>


        <?=$form->field($model, 'title')->textInput(['maxlength' => true])?>
        <?=$form->field($model, 'type')->dropDownList(Constants::getAdsType())?>
        <?=$form->field($model,'photo')->ueUpload([],['onclick'=>'setDefaultImg(this)','style'=>'width  :100px;max-width:100%']); ?>

        <?=$form->field($model, 'text')->textarea()?>
        <?=$form->field($model, 'link')->textInput()?>

        <?=$form->defaultButtons()?>
        <?php ActiveForm::end();?>
    </div>
</div>
<?php JsBlock::begin() ?>
<script>

    _editor = UE.getEditor('upload_ue',{"serverUrl": "/ads/ueditor"});

    _editor.ready(function () {
        _editor.setDisabled('insertimage');
        _editor.hide();

        _editor.addListener('beforeInsertImage', function (t, arg) {
            for(var i in arg) {

                var img = "<div style='display:inline-block;margin-top:10px'><img  onclick='setDefaultImg(this)' src='" + arg[i].src + "' style='width:100px;max-width:100%'>";
                img += "<input type='hidden' name='photo[]' value='" + arg[i].src + "'><p  style='margin-top:8px;text-align:center;cursor:pointer;color:red'><i onclick='moveLeft(this)' style='font-size:20px;color:green' class=\"fa fa-arrow-circle-left\" aria-hidden=\"true\"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i onclick='deleteImg(this)' class='glyphicon glyphicon-trash'' aria-hidden='true'></i>&nbsp;&nbsp;&nbsp;&nbsp;<i onclick='moveRight(this)' style='font-size:20px;color:green' class=\"fa fa-arrow-circle-right\" aria-hidden=\"true\"></i></p></div>";
                $('#image-list').append(img)
            }
        })
    })
    function loadChildList(type){
        $.get('<?=Url::to(['child-list', 'type' => ''])?>'+type, function(data){
            $('select#category-parent_id').html(data);
        });
    }

    function deleteImg(obj){
        $(obj).parent().parent().remove()
    }

    function moveLeft(obj){
        var clone = $(obj).parent().parent().clone();


        $(obj).parent().parent().prev().before(clone);
        if(typeof ($(obj).parent().parent().prev().html()) == 'undefined'){
            return false;
        }else{
            $(obj).parent().parent().remove();
        }


    }

    function moveRight(obj){
        var clone = $(obj).parent().parent().clone();


        $(obj).parent().parent().next().after(clone);
        if(typeof ($(obj).parent().parent().next().html()) == 'undefined'){
            return false;
        }else{
            $(obj).parent().parent().remove();
        }

    }

</script>
<?php JsBlock::end();?>
