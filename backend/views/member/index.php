<?php

use backend\grid\GridView;
use common\widgets\Pjax;

use backend\grid\CheckboxColumn;
use backend\grid\ActionColumn;
use backend\widgets\Bar;
use yii\helpers\Url;
use common\libs\Constants;
use yii\Helpers\Html;
use common\widgets\JsBlock;

$this->title = yii::t('member', 'page_title_member_list');
$this->description = yii::t('member', 'func_desc_member');
$this->params['breadcrumbs'][] = ['label' => Yii::t('member','page_title_member'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<!-- ./common buttons start -->
<div id="toolbar" class="toolbar">

    <!-- ./left buttons -->
    <?= Bar::widget(['template' => '{refresh} {create-layer} {delete}'])?>


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
            'attribute' => 'username',
        ],
        [
            'attribute' => 'real_name',
        ],
        [
            'attribute' => 'mobile',
        ],
        [
            'attribute' => 'email',
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

<?php JsBlock::begin() ?>
<script>

</script>
<?php JsBlock::end();?>
