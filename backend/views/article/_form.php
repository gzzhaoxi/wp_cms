<?php
use yii\Helpers\Url;
use backend\widgets\ActiveForm;
use common\libs\Constants;
use common\widgets\JsBlock;


?>
<style>
    .edui-faked-video{}
</style>
<div id="addForm">
    <div class="ibox-content">
        <?php $form = ActiveForm::begin(); ?>

        <?=$form->field($model, 'title')->textInput(['maxlength' => true])?>
        <?=$form->field($model, 'category_id')->dropDownList(\backend\models\Category::getCategoriesName(Constants::CATEGORY_TYPE_ARTICLE))?>
        <?=$form->field($model, 'author')->textInput(['maxlength' => true])?>
        <?=$form->field($model, 'keywords')->textInput()?>
        <?=$form->field($model, 'desc')->textarea()?>
        <?=$form->field($model, 'order')->textInput()?>
        <?=$form->field($model,'photo')->ueUpload(['filed'=>'Article[photo]'],['onclick'=>'setDefaultImg(this)','style'=>'width:50px']); ?>
        <?= $form->field($model, 'content')->widget('\common\widgets\ueditor\Ueditor',[
            'options'=>[
                'initialFrameWidth' => '100%',
                'initialFrameHeight' => 400,
                'dir' => 'article'
            ]
        ]) ?>
        <?=$form->field($model, 'is_top')->radioList(Constants::getYesNoItems(),['style'=>'position:relative;top:-6px'])?>
        <?=$form->field($model, 'is_push')->radioList(Constants::getYesNoItems(),['style'=>'position:relative;top:-6px'])?>
        <?=$form->defaultButtons()?>
        <?php ActiveForm::end();?>
    </div>
</div>
<?php JsBlock::begin() ?>
<script>

    _editor = UE.getEditor('upload_ue',{"serverUrl": "/article/ueditor"});

    _editor.ready(function () {
        _editor.setDisabled('insertimage');
        _editor.hide();
        console.log('haha')

        _editor.addListener('beforeInsertImage', function (t, arg) {
            for(var i in arg) {

                var img = "<div style='display:inline-block;margin-top:10px'><img  onclick='setDefaultImg(this)' src='" + arg[i].src + "' style='width:50px'>";
                img += "<input type='hidden' name='Article[photo]' value='" + arg[i].src + "'></div>";
                $('#image-list').html(img)
            }
        })
    })
    function loadChildList(type){
        $.get('<?=Url::to(['child-list', 'type' => ''])?>'+type, function(data){
            $('select#category-parent_id').html(data);
        });
    }
</script>
<?php JsBlock::end();?>
