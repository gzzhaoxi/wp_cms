<?php

use yii\Helpers\Url;
use backend\widgets\ActiveForm;
use common\libs\Constants;
use backend\models\Menu;
use common\widgets\JsBlock;

$parent_id = yii::$app->getRequest()->get('parent_id', '');
if ($parent_id != '') {
    $model->parent_id = $parent_id;
}
//echo $form->field($model, 'is_absolute_url')->radioList(Constants::getYesNoItems());
?>
<div id="addForm">
   <div class="ibox-content">

        <?php $form = ActiveForm::begin([]);?>
        <?=$form->field($model, 'type')->radioList(Constants::getMenuType(), ['onclick' => "loadMenus($('input:radio[name=\'Menu[type]\']:checked').val())"])?>
        <?=$form->field($model, 'parent_id')->dropDownList(Menu::getMenusName())?>
        <?=$form->field($model, 'name')->textInput(['maxlength' => 64])?>
        <?=$form->field($model, 'url')->textInput(['maxlength' => 512])?>
        <?=$form->field($model, 'method')->dropDownList(Constants::getHttpMethodItems())?>
        <?=$form->field($model, 'icon')->textInput(['maxlength' => 64])?>
        <?=$form->field($model, 'sort')->textInput(['maxlength' => 64])?>
        <?=$form->field($model, 'is_display')->radioList(Constants::getYesNoItems())?>

        <?=$form->defaultButtons()?>
        <?php ActiveForm::end()?>

   </div>
</div>
<?php JsBlock::begin() ?>
    <script>
        function loadMenus(type){
            $.get('<?=Url::to(['load-menu', 'type' => ''])?>'+type, function(data){
                $('select#menu-parent_id').html(data);
            });

        }
    </script>
<?php JsBlock::end();?>