<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProjectMsg */

$this->title = Yii::t('app', 'Create Project Msg');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Project Msgs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-msg-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
