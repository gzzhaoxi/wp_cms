<?php

use yii\Helpers\Url;
use backend\widgets\ActiveForm;
use common\libs\Constants;
use backend\models\Pdsetting;
use common\widgets\JsBlock;
?>

<div id="addForm">

    <div class="ibox-content">
        <?php $form = ActiveForm::begin(); ?>
        <div class="layui-collapse" >
            <div class="layui-colla-item">
                <h2 class="layui-colla-title">构建基本信息:</h2>
                <div class="layui-colla-content layui-show">
                    <?=$form->field($model, 'name')->textInput(['placeholder' => '请输入作业名称'])?>
                    <?=$form->field($model, 'type')->textInput(['placeholder' => '请输入作业名称'])?>
                    <?=$form->field($model, 'pcs')->textInput(['placeholder' => '作业一共多少面'])?>
                    <?=$form->field($model, 'amount')->textInput(['placeholder' => '作业份数:一共多少份或本'])?>
                </div>
            </div>


            <div class="layui-colla-item">
                <h2 class="layui-colla-title">打印费用计算:</h2>
                <div class="layui-colla-content">
                    <?=$form->field($model, 'print_type')->radioList(Pdsetting::getProductionData(Constants::PRODUCTION_PRINT))?>
                    <?=$form->field($model, 'size')->dropDownList(Pdsetting::getProductionData(Constants::PRODUCTION_SIZE))?>
                    <?=$form->field($model, 'paper')->dropDownList(Pdsetting::getProductionData(Constants::PRODUCTION_PAPER))?>
                    <?=$form->field($model, 'weight')->dropDownList(Pdsetting::getProductionData(Constants::PRODUCTION_WEIGH))?>
                    <?=$form->field($model, 'pages')->radioList(Pdsetting::getProductionData(Constants::PRODUCTION_PAGES))?>
                    <?=$form->field($model, 'price')->textInput()?>
                </div>
            </div>

        </div>

        <div style="min-height: 30px;">&nbsp;</div>

        <?=$form->defaultButtons()?>
        <?php ActiveForm::end();?>
    </div>
</div>
<?php JsBlock::begin() ?>
    <script>


    layui.use(['element', 'layer'], function(){
        var element = layui.element;
        var layer = layui.layer;

        element.init();
        //监听折叠
        /*
        element.on('collapse(test)', function(data){
            layer.msg('展开状态：'+ data.show);
        });*/

    });

    </script>
<?php JsBlock::end();?>