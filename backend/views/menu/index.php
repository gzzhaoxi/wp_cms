<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2016-03-21 14:14
 */

/**
 * @var $this yii\web\View
 * @var $dataProvider yii\data\ArrayDataProvider
 * @var $searchModel backend\models\MenuSearch
 */

use backend\grid\GridView;
use common\widgets\Pjax;
use backend\widgets\Bar;
use yii\helpers\Html;
use yii\helpers\Url;
use common\libs\Constants;
use backend\models\Menu;
use backend\grid\CheckboxColumn;
use backend\grid\ActionColumn;

$this->title = yii::t('app', 'page_title_admin_menu_index');
$this->description = yii::t('app', 'func_desc_admin_menu_index');
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
            'class' => CheckboxColumn::className(),
        ],
        [
            'attribute' => 'name',
            'label' => yii::t('app', 'pub_name'),
            'format' => 'html',
            'value' => function ($model, $key, $index, $column) {
                return str_repeat("--", $model['level'] - 1) . $model['name'];
            }
        ],
        [
            'attribute' => 'icon',
            'label' => yii::t('app', 'pub_image'),
            'format' => 'html',
            'value' => function ($model) {
                return "<i class=\"fa fa-{$model['icon']}\"></i>";
            }
        ],
        [
            'attribute' => 'type',
            'label' => yii::t('app', 'pub_type'),
            'format' => 'raw',
            'value' => function ($model) {
                return Constants::getMenuType($model['type']);
            }
        ],
        [
            'attribute' => 'url',
            'label' => yii::t('app', 'pub_route'),
            'width' => '140px',
        ],
        [
            'attribute' => 'sort',
            'label' => yii::t('app', 'pub_sort'),
            'format' => 'raw',
            'value' => function ($model) {
                return Html::input('number', "sort[{$model['id']}]", $model['sort']);
            }
        ],
        [
            'attribute' => 'method',
            'label' => yii::t('app', 'pub_http_method'),
            'value' => function ($model) {
                return Constants::getHttpMethodItems($model['method']);
            },
            'filter' => Constants::getHttpMethodItems(),
        ],
        [
            'attribute' => 'is_display',
            'label' => yii::t('app', 'pub_is_display'),
            'format' => 'raw',
            'value' => function ($model, $key, $index, $column) {
                if ($model['is_display'] == Menu::DISPLAY_YES) {
                    $url = Url::to([
                        'status',
                        'id' => $model['id'],
                        'status' => Menu::DISPLAY_NO,
                        'field' => 'is_display'
                    ]);
                    $class = 'btn btn-info btn-xs btn-rounded';
                    $confirm = Yii::t('app', 'Are you sure you want to disable this item?');
                } else {
                    $url = Url::to([
                        'status',
                        'id' => $model['id'],
                        'status' => Menu::DISPLAY_YES,
                        'field' => 'is_display'
                    ]);
                    $class = 'btn btn-default btn-xs btn-rounded';
                    $confirm = Yii::t('app', 'Are you sure you want to enable this item?');
                }
                return Html::a(Constants::getYesNoItems($model['is_display']), $url, [
                    'class' => $class,
                    'data-confirm' => $confirm,
                    'data-method' => 'post',
                    'data-pjax' => '0',
                ]);

            },
            'filter' => Constants::getYesNoItems(),
        ],
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
