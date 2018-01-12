<?php

use yii\helpers\Html;
use yii\helpers\Url;

use backend\grid\GridView;
use common\widgets\Pjax;
use common\widgets\JsBlock;
use backend\grid\CheckboxColumn;
use backend\grid\ActionColumn;
use backend\widgets\Bar;
use common\libs\Constants;

$this->title = yii::t('app', 'page_title_customer');
$this->description = yii::t('app', 'func_desc_customer');
$this->params['breadcrumbs'][] = $this->title;

?>

<!-- ./common buttons start -->
<div id="toolbar" class="toolbar">

    <!-- ./left buttons -->
    <?= Bar::widget(['template' => '{refresh} {create-layer} {update} {delete}'])?>


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
        'serial_no',
        [
            'attribute' => 'name',
        ],
        [
            'attribute' => 'status',
            'format' => 'raw',
            //'filter' => Constants::getStatus(),
            'value' => function($model, $key, $index, $column){
                return Constants::getStatus($model->status);
                //return Html::dropDownList('cus_status', $model->cus_status, Constants::getStatus(), ['onchange' => 'javascript:onChange($(this), '.$model->id.')']);
            }
        ],
        [
            'attribute' => 'level',
            'format' => 'raw',
            //'filter' => \backend\models\Rank::getTypeName(),
            'value' => function($model, $key, $index, $column){
                return \backend\models\Rank::getTypeName($model->level);
            }
        ],
        [
            'attribute' => 'sales_id',
            'format' => 'raw',
            //'filter' => \backend\models\Rank::getTypeName(),
            'value' => function($model, $key, $index, $column){
                return \backend\models\AdminUser::getUserNameById($model->sales_id);
            }
        ],
        [
            'attribute' => 'trade_type',
            'format' => 'raw',
            //'filter' => \backend\models\Rank::getTypeName(),
            'value' => function($model, $key, $index, $column){
                return Constants::getYesNoItems($model->trade_type);
            }
        ],
        // 'level',
        // 'sales_id',
        // 'recommend_id',
        // 'type',
        // 'trade_type',
        // 'linkman',
        // 'tel',
        // 'mobile',
        // 'qq',
        // 'province',
        // 'city',
        // 'area',
        // 'address',
        // 'created_at',
        // 'updated_at',

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
            'width' => '80px',
            'buttons' => [
                'address' => function ($url, $model, $key) {//  map-marker
                    return Html::a('<i class="fa  fa-location-arrow" aria-hidden="true"></i> ', Url::to([
                        'receiver/index',
                        'cid' => $model['id']
                    ]), [
                        'title' => Yii::t('app', 'Create'),
                        'data-pjax' => '0',
                        'class' => 'btn btn-success btn-xs ',
                    ]);
                }
            ],
            'template' => '{view-layer} {address} {update-layer} {delete}',
        ]
    ],
]); ?>
<?php Pjax::end();?>

