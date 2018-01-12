<?php

use yii\helpers\Html;

use backend\widgets\ActiveForm;
use yii\helpers\Url;
use backend\models\AdminUser;
use backend\models\AdminRoles;

?>


<div id="addForm">
    <div class="ibox-content">
        <?php $form = ActiveForm::begin([]);?>
        <?=$form->field($model, 'username')->textInput(['maxlength' => 64])?>
        <?=$form->field($model, 'password')->passwordInput(['maxlength' => 512])?>
        <?=$form->field($model, 'email')->textInput(['maxlength' => 64])?>
        <?=$form->field($model, 'status')->radioList(AdminUser::getStatuses())?>
        <?=$form->field($rolesModel, 'role_id', [
            'labelOptions' => [
                'label' => yii::t('app', 'role'),
            ]
        ])->radioList(AdminRoles::getRolesNames()) ?>
        <?=$form->defaultButtons()?>
        <?php ActiveForm::end()?>
    </div>
</div>
