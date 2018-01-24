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

        <?=$form->field($model, 'username')->textInput(['maxlength' => true])?>
        <?=$form->field($model, 'password')->passwordInput()?>
        <?=$form->field($model, 'email')->textInput()?>

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

    $('#user-password').val('')
</script>
<?php JsBlock::end();?>
