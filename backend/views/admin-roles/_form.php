<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2016-04-11 22:03
 */

/**
 * @var $this yii\web\View
 * @var $model backend\models\AdminRoles
 */

use backend\widgets\ActiveForm;
use yii\helpers\Url;
use backend\models\AdminRoles;

?>


<div id="addForm">
    <div class="ibox-content">
        <?php $form = ActiveForm::begin([]);?>
        <?= $form->field($model, 'role_name')->textInput(['maxlength' => 64]) ?>
        <?= $form->field($model, 'remark')->textInput(['maxlength' => 64]) ?>
        <?=$form->defaultButtons()?>
        <?php ActiveForm::end()?>
    </div>
</div>


