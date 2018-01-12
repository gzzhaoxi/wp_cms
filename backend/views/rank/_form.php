<?php

use backend\widgets\ActiveForm;
use common\libs\Constants;

?>

<div id="rankForm">
    <div class="ibox-content">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'type')->radioList(\backend\models\Rank::getType()) ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'status')->radioList(Constants::getStatus()) ?>
    <?= $form->field($model, 'order')->textInput(['maxlength' => true]) ?>

    <?=$form->defaultButtons()?>
    <?php ActiveForm::end()?>

    </div>
</div>
