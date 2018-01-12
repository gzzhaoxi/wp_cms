<?php

use backend\widgets\ActiveForm;
use common\libs\Constants;
use backend\models\Customer;
use common\models\Region;

$rs = Customer::getCustomerInfo(yii::$app->getRequest()->get('cid', ''));
//
$template = "{label}\n<div class='col-sm-8 col-xs-12' style='padding-top: 8px;'>".$rs->name."</div>";
//echo Yii::$app->getRequest()->get('id','');

?>

<div id="addressForm">
    <div class="ibox-content">

        <?php $form = ActiveForm::begin(); ?>
        <?=$form->field($model, 'customer_id')->textInput()->hiddenInput(['value'=> Yii::$app->getRequest()->get('cid','')])->label(false)?>
        <?= $form->field($model, 'customer_name', ['template' => $template]); ?>
        <?= $form->field($model, 'receiver_name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'district')->widget(\common\widgets\region\Region::className(),[
            'model'=>$model,
            'url'=> \yii\helpers\Url::toRoute(['get-region']),
            'province'=>[
                'attribute'=>'province',
                'items'=>Region::getRegion(),
                'options'=>[
                    //'class' => 'form-control form-control-inline',
                    'style' => 'width:160px; height: 34px; padding: 6px 12px; border: 1px solid #ccc; background-color: #fff;',
                    'prompt' => yii::t('app', 'pub_please_select').yii::t('app', 'pub_province')
                ]
            ],
            'city'=>[
                'attribute'=>'city',
                'items'=>Region::getRegion($model['province']),
                'options'=>[
                    //'class'=>'form-control form-control-inline',
                    'style' => 'width:160px; height: 34px; padding: 6px 12px; border: 1px solid #ccc; background-color: #fff;',
                    'prompt'=>yii::t('app', 'pub_please_select').yii::t('app', 'pub_city')
                ]
            ],
            'district'=>[
                'attribute'=>'district',
                'items'=>Region::getRegion($model['city']),
                'options'=>[
                    //'class'=>'form-control form-control-inline',
                    'style' => 'width:160px; height: 34px; padding: 6px 12px; border: 1px solid #ccc; background-color: #fff;',
                    'prompt'=>yii::t('app', 'pub_please_select').yii::t('app', 'pub_area')
                ]
            ]
        ]);
        ?>
        <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'zipcode')->textInput() ?>
        <?= $form->field($model, 'building')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'is_default')->radioList(Constants::getYesNoItems()) ?>


        <?=$form->defaultButtons()?>
        <?php ActiveForm::end()?>

    </div>
</div>
