<?php

use backend\grid\GridView;
use common\widgets\Pjax;
use common\widgets\JsBlock;
use backend\grid\CheckboxColumn;
use backend\grid\ActionColumn;
use backend\widgets\Bar;
use common\libs\Constants;

$this->title = yii::t('app', 'page_title_order_index');
$this->description = yii::t('app', 'func_desc_order_index');
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- ./common buttons start -->
<div id="toolbar" class="toolbar">

    <!-- ./left buttons -->
    <?= Bar::widget(['template' => '{refresh} {create} {update} {delete}'])?>


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
            'order_no',
            'customer_id',
            // 'sales_id',
            // 'project_id',
            // 'address_id',
            // 'prepay_amount',
            // 'unpay_amount',
            // 'free_amount',
            // 'discount',
            // 'express_cost',
            // 'status_pay',
            // 'status_confirm',
            // 'status_send',
            // 'express_type',
            // 'express_code',
            // 'produce_content:ntext',
            // 'remark',

            [
                'attribute' => 'created_at',
                'format' => 'date',
            ],
            [
                'attribute' => 'updated_at',
                'format' => 'date',
            ],
            [
                'class' => ActionColumn::class,
                'template' => '{update-layer} {delete}',
            ]
        ],
    ]); ?>
<?php Pjax::end();?>
