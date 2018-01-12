<?php

use yii\bootstrap\Html;
use yii\helpers\Url;
use backend\widgets\ActiveForm;
use common\libs\Constants;
use common\widgets\JsBlock;


$res_url = Url::toRoute(['customer/create']);
?>

<div id="addForm">
    <!--<div class="ibox-content">-->

        <div class="margin">
            <div class="alert alert-dismissable bg-info">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>栏目</strong>: 栏目类型下不可以发布文章,但可以添加子栏目、列表、链接<br>

            </div>
        </div>

        <?php $form = ActiveForm::begin(); ?>


        <?=
        $form->field($model, 'customer_id', [
            'template' => "{label}\n<div class='col-lg-6'>{input}</div>\n
                                    <div class='col-lg-2'>
                                        ".
                                        Html::a('<i class="fa fa-user-plus"></i> ' . yii::t('app', 'btn_bar_create').yii::t('app', 'btn_bar_customer'), 'javascript:;', [
                                            'title' => yii::t('app', 'btn_bar_create').yii::t('app', 'btn_bar_customer'),
                                            'data-pjax' => '0',
                                            'class' => 'btn btn-success btn-add',
                                            'onClick' => "onAddCustomer($(this))",
                                        ])
                                        ."
                                    </div>\n{error}",
            'labelOptions' => ['class' => 'col-lg-2 control-label'],//->hint('错误提示信息')
        ])->dropDownList(\backend\models\Customer::getClientInfo(), ['onchange' => 'loadAddress($(this).val())'])->label(yii::t('app', 'customer_id'))
        ?>
        <?=
        $form->field($model, 'address_id', [
            'template' => "{label}\n<div class='col-lg-6'>{input}</div>\n
                                        <div class='col-lg-2'>
                                            ".
                Html::a('<i class="fa fa-map-marker"></i> ' . yii::t('app', 'btn_bar_create').yii::t('app', 'btn_bar_address'), 'javascript:;', [
                    'title' => yii::t('app', 'btn_bar_create').yii::t('app', 'btn_bar_address'),
                    'data-pjax' => '0',
                    'class' => 'btn btn-warning btn-add',
                    'onClick' => "onAddReceiver($(this))",
                ])
                ."
                                        </div>\n{error}",
            'labelOptions' => ['class' => 'col-lg-2 control-label'],//->hint('错误提示信息')
        ])->dropDownList([])->label(yii::t('app', 'receiver_id'))
        ?>

        <div class="form-group">
            <label class="col-lg-2 control-label" for="order-customer_id">作业信息</label>
            <div class="col-md-10 droppable sortable ui-droppable ui-sortable" style="">
                <?=
                Html::a('<i class="fa fa-list-alt"></i> 添加作业信息' , 'javascript:;', [
                    'title' => '添加作业信息',
                    'data-pjax' => '0',
                    'class' => 'btn btn-warning btn-add',
                    'onClick' => "onAddProduction($(this))",
                ])
                ?>
            </div>
        </div>


        <?=$form->defaultButtons()?>
        <?php ActiveForm::end()?>


    <!--</div>-->
</div>
<?php JsBlock::begin() ?>
    <script>
        function onAddCustomer(obj)
        {

            $.ajax({
                url: '<?=Url::toRoute(['customer/add-customer'])?>',
                success: function (data) {
                    var index = layer.open({
                        type: 1,
                        title: obj.attr('title'),
                        maxmin: true,
                        shadeClose: true,
                        skin: 'layui-layer-molv',
                        area: ['70%', '80%'],
                        content: data,
                    });
                    $("form#w0").bind('submit', function () {

                        var $form = $(this);
                        $.ajax({
                            url: $form.attr('action'),
                            type: "post",
                            data: $form.serialize(),
                            success: function (data) {
                                if (data.code == 1) {
                                    layer.close(index);
                                    //$('select#order-customer_id').html();
                                    refreshCustomer();
                                } else {
                                    layer.msg(data.err_msg);
                                }
                            }
                        }).always(function () {
                            //clearTimeout(index);
                        });
                        return false;
                    });
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert("请求发生（Ajax）错误:" + textStatus + ' : ' + errorThrown);
                },
                complete: function (XMLHttpRequest, textStatus) {
                }
            });
        }

        //当前添加完客户资料后即选中
        function refreshCustomer(){
            $.get('<?=Url::to(['customer/load-info'])?>', function(data){
                $('select#order-customer_id').html(data);
            });
        }

        //根据选中的客户信息,装载客户收货人地址信息
        function loadAddress(uid){
            $.get('<?=Url::to(['receiver/load-info', 'id' => ''])?>'+uid, function(data){
                $('select#order-address_id').html(data);
            });
        }

        //
        function onAddReceiver(obj){
            var curr_user_id = $('select#order-customer_id').val();
            if(!curr_user_id){
                layer.msg('请先选择一个客户或添加新客户信息!');
            }else{
                $.ajax({
                    url: '<?=Url::toRoute(['receiver/add-refer', 'cid' => ''])?>' + curr_user_id,
                    success: function (data) {
                        var index = layer.open({
                            type: 1,
                            title: obj.attr('title'),
                            maxmin: true,
                            shadeClose: true,
                            skin: 'layui-layer-molv',
                            area: ['70%', '80%'],
                            content: data,
                        });
                        $("form#w0").bind('submit', function () {

                            var $form = $(this);
                            $.ajax({
                                url: $form.attr('action'),
                                type: "post",
                                data: $form.serialize(),
                                success: function (data) {
                                    if (data.code == 1) {
                                        layer.close(index);
                                        //$('select#order-customer_id').html();
                                        refreshAddress(curr_user_id);
                                    } else {
                                        layer.msg(data.err_msg);
                                    }
                                }
                            }).always(function () {
                                //clearTimeout(index);
                            });
                            return false;
                        });
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alert("请求发生（Ajax）错误:" + textStatus + ' : ' + errorThrown);
                    },
                    complete: function (XMLHttpRequest, textStatus) {
                    }
                });
            }
        }

        //
        function refreshAddress(uid){
            $.get('<?=Url::to(['receiver/load-info', 'id' => ''])?>'+uid, function(data){
                $('select#order-address_id').html(data);
            });
        }

        //
        function onAddProduction(obj){
            $.ajax({
                url: '<?=Url::toRoute(['production/create'])?>',
                success: function (data) {
                    var index = layer.open({
                        type: 1,
                        title: obj.attr('title'),
                        maxmin: true,
                        shadeClose: true,
                        skin: 'layui-layer-molv',
                        area: ['70%', '80%'],
                        content: data,
                    });
                    $("form#w0").bind('submit', function () {

                        var $form = $(this);
                        $.ajax({
                            url: $form.attr('action'),
                            type: "post",
                            data: $form.serialize(),
                            success: function (data) {
                                if (data.code == 1) {
                                    layer.close(index);
                                    //$('select#order-customer_id').html();
                                    refreshCustomer();
                                } else {
                                    layer.msg(data.err_msg);
                                }
                            }
                        }).always(function () {
                            //clearTimeout(index);
                        });
                        return false;
                    });
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert("请求发生（Ajax）错误:" + textStatus + ' : ' + errorThrown);
                },
                complete: function (XMLHttpRequest, textStatus) {
                }
            });
        }
    </script>
<?php JsBlock::end();?>