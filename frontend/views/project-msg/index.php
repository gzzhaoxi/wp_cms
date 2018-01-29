<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ProjectMsgSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Project Msgs');
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
  <a href="/project-msg/index" class="list-group-item active">
    Show All
  </a>
  <a href="/projects/index" class="list-group-item">Projects</a>
</div>
</div>
<div class="col-md-10 col-sm-10 col-xs-12">
<div class="project-msg-index">
    <?php echo $this->render('_search', ['model' => $searchModel,'keyword' => $keyword]); ?>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//         'filterModel' => $searchModel,
        'columns' => [
            'name',
            'tel',
//             'email:email',
            'msg:ntext',
            [
            'attribute' => 'project_id',
            'format' => 'raw',
            'label' => 'Project',
            'value' => function ($model){
                return $model->project['name'];
            }
            ],
            [
                'attribute' => 'created_at',
                'label' => 'Date',
                'format' => 'date',
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
</div>
</div>
