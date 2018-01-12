<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2016-03-21 14:35
 */

/**
 * @var $this yii\web\View
 * @var $model backend\models\Menu
 */

use backend\widgets\ActiveForm;
use common\libs\Constants;
use backend\models\Menu;



$parent_id = yii::$app->getRequest()->get('parent_id', '');
if ($parent_id != '') {
    $model->parent_id = $parent_id;
}
//echo $form->field($model, 'is_absolute_url')->radioList(Constants::getYesNoItems());
?>
<div id="addForm">
   <div class="ibox-content">

        <?php $form = ActiveForm::begin([]);?>
        <?=$form->field($model, 'parent_id')->dropDownList(Menu::getMenusName(Menu::BACKEND_TYPE))?>
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