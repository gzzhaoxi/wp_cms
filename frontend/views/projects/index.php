<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ProjectsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Projects');
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
.table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td,
.table-bordered,.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{
	border:unset;
}
</style>
<div class="row">
<div class="col-md-2 col-sm-2 col-xs-12">
<div class="list-group">
  <a href="/project-msg/index" class="list-group-item ">
    Show All
  </a>
  <a href="/projects/index" class="list-group-item active">Projects</a>
</div>
</div>
<div class="col-md-10 col-sm-10 col-xs-12">
<div class="projects-index">
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//         'filterModel' => $searchModel,
        'columns' => [

            'name',
            'office_name',
            'address:ntext',
            'link',
            // 'msg:ntext',
            // 'photo',
            // 'status',
            // 'must_input',
            [
                'attribute' => 'created_at',
                'format' => 'date',
            ],
            // 'updated_at',
            'hit',
            [
                'attribute' => 'msg_count',
                'label'=> 'Message',
                'format' => 'raw',
                'value' => function ($model) use ($msg_data){
                    return $msg_data[$model->id]['cou'];
                }
            ],
            // 'user_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
</div>
</div>
