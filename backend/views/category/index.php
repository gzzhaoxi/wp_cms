<?php

use backend\grid\GridView;
use common\widgets\Pjax;

use backend\grid\CheckboxColumn;
use backend\grid\ActionColumn;
use backend\widgets\Bar;

use common\libs\Constants;
use yii\Helpers\Html;

$this->title = yii::t('app', 'page_title_category');
$this->description = yii::t('app', 'func_desc_category');
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
    'layout' => "{items}\n{pager}",
    'columns' => [
        [
            'class' => CheckboxColumn::class,
        ],
        [
            'attribute' => 'name',
        ],
        [
            'attribute' => 'type',
            'format' => 'raw',
            'filter' => Constants::getTopCategory(),
            'value' => function($model, $key, $index, $column){
                return Constants::getTopCategory($model->type);
                //return Html::dropDownList('cus_status', $model->cus_status, Constants::getStatus(), ['onchange' => 'javascript:onChange($(this), '.$model->id.')']);
            }
        ],
        [
            'attribute' => 'parent_id',
            'format' => 'raw',
            'filter' => \backend\models\Category::getCateName(),
            'value' => function($model, $key, $index, $column){
                if($model->parent_id){
                    return \backend\models\Category::getCateName($model->parent_id);
                }
            }
        ],
        [
            'attribute' => 'weigh',
        ],
        [
            'attribute' => 'status',
            'format' => 'raw',
            'filter' => Constants::getStatus(),
            'value' => function($model, $key, $index, $column){
                return Constants::getStatus($model->status);
                //return Html::dropDownList('cus_status', $model->cus_status, Constants::getStatus(), ['onchange' => 'javascript:onChange($(this), '.$model->id.')']);
            }
        ],
        [
            'attribute' => 'created_at',
            'format' => 'date',
            'width' => '70px',
        ],
        [
            'attribute' => 'updated_at',
            'format' => 'date',
            'width' => '70px',
        ],
        [
            'class' => ActionColumn::class,
            'width' => '60px',
            'template' => '{view-layer} {update-layer} {delete}',
        ]
    ],
]); ?>
<?php Pjax::end();?>