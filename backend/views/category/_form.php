<?php
use yii\Helpers\Url;
use backend\widgets\ActiveForm;
use common\libs\Constants;
use common\widgets\JsBlock;


?>

<div id="addForm">
    <div class="ibox-content">
        <?php $form = ActiveForm::begin(); ?>
        <?=$form->field($model, 'type')->dropDownList(
            Constants::getTopCategory(), ['onchange' => 'loadChildList($(this).val())']
        )
        ?>
        <?=$form->field($model, 'parent_id')->dropDownList([])?>
        <?=$form->field($model, 'name')->textInput(['maxlength' => true])?>
        <?=$form->field($model, 'nickname')->textInput()?>
        <?=$form->field($model, 'flag')->dropDownList(array())?>
        <?=$form->field($model, 'status')->radioList(Constants::getStatus())?>
        <?=$form->field($model, 'weigh')->textInput()?>
        <?=$form->field($model, 'keywords')->textInput()?>
        <?=$form->field($model, 'description')->textarea(['rows' => 2])?>

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
</script>
<?php JsBlock::end();?>
