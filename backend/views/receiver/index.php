<?php

use backend\grid\GridView;
use common\widgets\Pjax;
use common\widgets\JsBlock;
use backend\grid\CheckboxColumn;
use backend\grid\ActionColumn;
use backend\widgets\Bar;
use common\libs\Constants;
use yii\helpers\Html;
use yii\Helpers\Url;

$this->title = yii::t('app', 'page_title_receiver');
$this->description = yii::t('app', 'func_desc_receiver');
$this->params['breadcrumbs'][] = $this->title;

//$res_url = Url::to(['create', 'id' => yii::$app->getRequest()->get('id')]);
$create_layer_new = function () {
    return Html::a('<i class="fa fa-plus"></i> ' . yii::t('app', 'btn_bar_create'), 'javascript:;',
        [
            'title' => yii::t('app', 'btn_bar_create'),
            'onClick' => "onCreate($(this), '" .Url::to(['create', 'cid' => yii::$app->getRequest()->get('cid')]). "')",
            'class' => 'btn btn-success btn-add',
        ]);
};
?>

<!-- ./common buttons start -->
<div id="toolbar" class="toolbar">

    <!-- ./left buttons -->
    <?= Bar::widget([
        'template' => '{refresh} {create_layer_new} {update} {delete}',
        //'template' => '{refresh} {create-layer} {update} {delete}',
        'buttons' => ['create_layer_new' => $create_layer_new]
        ])
    ?>


    <!-- ./right buttons -->
    <!--
    <div class="dropdown btn-group">
        <a class="btn btn-primary btn-more dropdown-toggle btn-disabled disabled" data-toggle="dropdown"><i class="fa fa-cog"></i> {:__('More')}</a>
        <ul class="dropdown-menu text-left" role="menu">
            <li><a class="btn btn-link btn-multi btn-disabled disabled" href="javascript:;" data-params="status=normal"><i class="fa fa-eye"></i> {:__('Set to normal')}</a></li>
            <li><a class="btn btn-link btn-multi btn-disabled disabled" href="javascript:;" data-params="status=hidden"><i class="fa fa-eye-slash"></i> {:__('Set to hidden')}</a></li>
        </ul>
    </div>
    -->
</div>
<!-- ./common buttons end -->

<?php Pjax::begin(['id' => 'pjax']); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => CheckboxColumn::class,
            ],
            'receiver_name',
            'tel',
            'zipcode',
            [
                'attribute' => 'address',
                'format' => 'raw',
                //'filter' => \backend\models\Rank::getType(),
                'value' => function($model, $key, $index, $column){
                    return \common\models\Region::getRegionName([$model['province'],$model['city'],$model['district']]).$model['address'];
                    //return Html::dropDownList('cus_status', $model->cus_status, Constants::getStatus(), ['onchange' => 'javascript:onChange($(this), '.$model->id.')']);
                }
            ],


            // 'building',
            // 'is_default',
            // 'is_delete',
            [
                'class' => ActionColumn::class,
                'buttons' => [
                    'update_layer' =>  function($url, $model, $key){
                        $res_url = Url::to(['update', 'cid' => $model['customer_id'], 'id' => $model['id']]);
                        return Html::a('<i class="fa  fa-pencil" aria-hidden="true"></i> ', 'javascript:;', [
                            'title' => Yii::t('app', 'btn_bar_update'),
                            'onclick' => 'updateAddress("'.$res_url.'", $(this))',
                            'data-pjax' => '0',
                            'class' => 'btn btn-info btn-xs',
                        ]);
                    }
                ],
                'template' => '{update_layer} {delete}',
            ]
        ],
    ]); ?>
<?php Pjax::end();?>
<?php JsBlock::begin() ?>
    <script>
        function updateAddress(res_url, obj){
            $.ajax({
                url: res_url,
                success: function (data) {
                    layer.open({
                        type: 1,
                        title: obj.attr('title'),
                        maxmin: true,
                        shadeClose: true,
                        skin: 'layui-layer-molv',
                        area: ['70%', '80%'],
                        content: data,
                    });//[name=edit]
                    $("form#w0").bind('submit', function () {
                        /*
                         var index = parent.layer.load(1, {
                         shade: [0.1,'red'] //0.1透明度的白色背景
                         });*/
                        var $form = $(this);
                        $.ajax({
                            url: $form.attr('action'),
                            type: "post",
                            data: $form.serialize(),
                            success: function (data) {
                                layer.msg(data.err_msg);
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