<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Projects */

$this->title = Yii::t('app', 'Create Projects');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Projects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="pricing" class="pricing-section">
  <div class="container">
  
    <div class="row">
    <a class="btn btn-success" href="javascript:void(0)" role="button">Create</a>&nbsp;<a class="btn btn-default disabled" href="javascript:void(0)" role="button">Preview</a>&nbsp;<a class="btn btn-default disabled" href="javascript:void(0)" role="button">Share</a>
    </div>
    <div class="row">
<div class="projects-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
</div>
</div>
