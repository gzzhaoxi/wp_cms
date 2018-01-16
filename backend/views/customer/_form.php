<?php

use backend\widgets\ActiveForm;
use common\libs\Constants;
use backend\models\Customer;
use backend\models\Rank;
use common\models\Region;
?>

<div id="customerForm">
    <div class="ibox-content">
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'sales_id')->dropDownList(\backend\models\AdminUser::getSalesGroup()) ?>
        <?= $form->field($model, 'status')->radioList(Constants::getStatus()) ?>
        <?= $form->field($model, 'level')->dropDownList(Rank::getTypeCase(Rank::TYPE_RANK)) ?>

        <!--<?= $form->field($model, 'recommend_id')->textInput() ?>-->
        <?= $form->field($model, 'type')->dropDownList(Rank::getTypeCase(Rank::TYPE_CASE)) ?>
        <?= $form->field($model, 'trade_type')->radioList(Constants::getYesNoItems()) ?>
        <?= $form->field($model, 'linkman')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'qq')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

        <?=$form->defaultButtons()?>
        <?php ActiveForm::end()?>

    </div>
</div>

