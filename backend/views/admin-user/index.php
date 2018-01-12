<?php
use backend\grid\GridView;
use common\widgets\Pjax;
use common\widgets\JsBlock;
use backend\grid\CheckboxColumn;
use backend\grid\ActionColumn;
use backend\widgets\Bar;
use common\libs\Constants;
use backend\models\AdminRoles;
use backend\models\AdminUser;

$this->title = yii::t('app', 'page_title_admin_user_index');
$this->description = yii::t('app', 'func_desc_admin_user_index');
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
        [
            'attribute' => 'username',
        ],
        [
            'attribute' => 'status',
            'format' => 'raw',
            'filter' => AdminUser::showStatus(),
            'value' => function($model){
                return AdminUser::showStatus($model->status);

            }
        ],
        [
            'attribute' => 'email',
        ],
        [
            'attribute' => 'role',
            'label' => yii::t('app', 'role'),
            'value' => function ($model) {
                return AdminRoles::getRoleNameByUid($model->id);
            },
        ],
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
            //'buttons' => ['assignment' => $assignment],
        ]
    ],
]); ?>
<?php Pjax::end();?>

