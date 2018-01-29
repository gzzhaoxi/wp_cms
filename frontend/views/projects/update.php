<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Projects */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Projects',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Projects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div id="pricing" class="pricing-section">
  <div class="container">
  
    <div class="row">
    <a class="btn btn-success" href="javascript:void(0)" role="button">Update</a>&nbsp;<a class="btn btn-success" href="/projects/show?<?=$key_value?>" role="button">Preview</a>&nbsp;<a class="btn btn-success" href="projects/view?id=<?=$model->id?>" role="button">Share</a>
    </div>
    <div class="row">
<div class="projects-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
</div>
</div>
</div>
