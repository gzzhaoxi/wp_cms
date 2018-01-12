<?php

use backend\grid\GridView;
use common\widgets\Pjax;
use backend\widgets\Bar;
use yii\helpers\Html;
use yii\helpers\Url;
use common\libs\Constants;
use backend\models\Production;
use backend\grid\CheckboxColumn;
use backend\grid\ActionColumn;

$this->title = yii::t('app', 'page_title_production_index');
$this->description = yii::t('app', 'func_desc_production_index');
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
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => CheckboxColumn::className(),
            ],
            'code',
            'name',
            'type',
            'size',
            'unit',
            // 'paper',
            // 'weight',
            // 'pages',
            'status',
            // 'created_at',
            // 'updated_at',
            [
                'attribute' => 'created_at',
                'label' => yii::t('app', 'pub_created_at'),
                'format' => 'date'
            ],
            [
                'attribute' => 'updated_at',
                'label' => yii::t('app', 'pub_updated_at'),
                'format' => 'date',
            ],
            [
                'class' => ActionColumn::className(),
                'width' => '120px',
                'template' => '{update-layer} {delete}',
            ]
        ]
    ]); ?>
<?php Pjax::end();?>
