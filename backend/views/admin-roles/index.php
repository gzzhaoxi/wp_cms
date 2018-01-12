<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2016-04-11 22:11
 */

/**
 * @var $this yii\web\View
 * @var $dataProvider yii\data\ActiveDataProvider
 */

use yii\helpers\Url;
use backend\grid\GridView;
use yii\helpers\Html;
use backend\widgets\Bar;
use backend\grid\CheckboxColumn;
use backend\grid\ActionColumn;
use common\widgets\JsBlock;

$this->title = yii::t('app', 'Roles');

$this->title = yii::t('app', 'page_title_admin_role_user');
$this->description = yii::t('app', 'func_desc_admin_role_user');
$this->params['breadcrumbs'][] = $this->title;

$assignment = function($url, $model){
    return Html::a('<i class="fa fa-magnet" aria-hidden="true"></i> ', 'javascript:;', [
        'title' => Yii::t('app', 'btn_bar_assign_pms'),
        'onclick' => 'onAssign('.$model['id'].',$(this))',
        'data-pjax' => '0',
        'class' => 'btn btn-danger btn-xs',
        //'name' => 'assign',
    ]);
};
?>


<?php JsBlock::begin() ?>
<script>
    var pms_url = '<?=Url::to(['assign', 'id' => ''])?>';
</script>
<?php JsBlock::end();?>

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

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'layout' => "{items}\n{pager}",
    'columns' => [
        [
            'class' => CheckboxColumn::className(),
        ],
        [
            'attribute' => 'role_name',
        ],
        [
            'attribute' => 'remark',
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
            'width' => '120px',
            'template' => '{assignment} {update-layer} {delete}',
            'buttons' => ['assignment' => $assignment],
        ],
    ]
]); ?>
