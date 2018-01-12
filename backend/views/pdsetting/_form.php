<?php

use yii\Helpers\Url;
use backend\widgets\ActiveForm;
use common\libs\Constants;

?>

<div id="addForm">
    <div class="ibox-content">

        <div class="margin">
            <div class="alert alert-dismissable bg-info">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>栏目</strong>: 栏目类型下不可以发布文章,但可以添加子栏目、列表、链接<br>

            </div>
        </div>

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'type')->radioList(Constants::getProductionSetting()) ?>
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'order')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'status')->radioList(Constants::getStatus()) ?>
        <?= $form->field($model, 'remark')->textarea(['maxlength' => true]) ?>

        <?=$form->defaultButtons()?>
        <?php ActiveForm::end();?>
    </div>
</div>

