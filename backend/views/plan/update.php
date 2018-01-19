<?php
$this->title = yii::t('plan', 'page_title_plan_update');
$this->description = yii::t('plan', 'func_desc_plan_update');
$this->params['breadcrumbs'][] = ['label' => Yii::t('plan','page_title_plan'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('_form', ['model' => $model,]);

