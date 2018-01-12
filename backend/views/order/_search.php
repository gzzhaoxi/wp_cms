<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\OrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'created_at') ?>

    <?= $form->field($model, 'updated_at') ?>

    <?= $form->field($model, 'customer_id') ?>

    <?= $form->field($model, 'order_no') ?>

    <?php // echo $form->field($model, 'sales_id') ?>

    <?php // echo $form->field($model, 'project_id') ?>

    <?php // echo $form->field($model, 'address_id') ?>

    <?php // echo $form->field($model, 'prepay_amount') ?>

    <?php // echo $form->field($model, 'unpay_amount') ?>

    <?php // echo $form->field($model, 'free_amount') ?>

    <?php // echo $form->field($model, 'discount') ?>

    <?php // echo $form->field($model, 'express_cost') ?>

    <?php // echo $form->field($model, 'status_pay') ?>

    <?php // echo $form->field($model, 'status_confirm') ?>

    <?php // echo $form->field($model, 'status_send') ?>

    <?php // echo $form->field($model, 'express_type') ?>

    <?php // echo $form->field($model, 'express_code') ?>

    <?php // echo $form->field($model, 'produce_content') ?>

    <?php // echo $form->field($model, 'remark') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
