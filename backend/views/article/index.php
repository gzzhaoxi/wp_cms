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

$this->title = yii::t('article', 'page_title_article_list');
$this->description = yii::t('article', 'func_desc_article');
$this->params['breadcrumbs'][] = ['label' => Yii::t('article','page_title_article'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<!-- ./common buttons start -->
<div id="toolbar" class="toolbar">

    <!-- ./left buttons -->
    <?= Bar::widget(['template' => '{refresh} {create} {delete}'])?>


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
            'attribute' => 'title',
        ],
        [
            'attribute' => 'author',
        ],
        [
            'attribute' => 'read_count',
        ],
        [
            'attribute' => 'order',
        ],
        [
            'attribute' => 'is_top',
            'label' => yii::t('article', 'is_top'),
            'format' => 'raw',
            'value' => function ($model, $key, $index, $column) {
                if ($model['is_top'] == Constants::YesNo_Yes) {
                    $url = Url::to([
                        'status',
                        'id' => $model['id'],
                        'status' => Constants::YesNo_No,
                        'field' => 'is_top'
                    ]);
                    $class = 'btn btn-info btn-xs btn-rounded';
                    $confirm = Yii::t('app', 'Are you sure you want to disable this item?');
                } else {
                    $url = Url::to([
                        'status',
                        'id' => $model['id'],
                        'status' => Constants::YesNo_Yes,
                        'field' => 'is_top'
                    ]);
                    $class = 'btn btn-default btn-xs btn-rounded';
                    $confirm = Yii::t('app', 'Are you sure you want to enable this item?');
                }
                return Html::a(Constants::getYesNoItems($model['is_top']), $url, [
                    'class' => $class,
                    'data-confirm' => $confirm,
                    'data-method' => 'post',
                    'data-pjax' => '0',
                ]);

            },
            'filter' => Constants::getYesNoItems(),
        ],
        [
            'attribute' => 'is_push',
            'label' => yii::t('article', 'is_push'),
            'format' => 'raw',
            'value' => function ($model, $key, $index, $column) {
                if ($model['is_push'] == Constants::YesNo_Yes) {
                    $url = Url::to([
                        'status',
                        'id' => $model['id'],
                        'status' => Constants::YesNo_No,
                        'field' => 'is_push'
                    ]);
                    $class = 'btn btn-info btn-xs btn-rounded';
                    $confirm = Yii::t('app', 'Are you sure you want to disable this item?');
                } else {
                    $url = Url::to([
                        'status',
                        'id' => $model['id'],
                        'status' => Constants::YesNo_Yes,
                        'field' => 'is_push'
                    ]);
                    $class = 'btn btn-default btn-xs btn-rounded';
                    $confirm = Yii::t('app', 'Are you sure you want to enable this item?');
                }
                return Html::a(Constants::getYesNoItems($model['is_push']), $url, [
                    'class' => $class,
                    'data-confirm' => $confirm,
                    'data-method' => 'post',
                    'data-pjax' => '0',
                ]);

            },
            'filter' => Constants::getYesNoItems(),
        ],
        [
            'attribute' => 'is_delete',
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
            'template' => '{view-layer} {update} {delete}',
        ]
    ],
]); ?>
<?php Pjax::end();?>

<?php JsBlock::begin() ?>
<script>

</script>
<?php JsBlock::end();?>
