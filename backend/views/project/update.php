<?php
$this->title = yii::t('project', 'page_title_project_view');
$this->description = yii::t('project', 'func_desc_project_view');
$this->params['breadcrumbs'][] = ['label' => Yii::t('project','page_title_project'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('_form', ['model' => $model,]);

