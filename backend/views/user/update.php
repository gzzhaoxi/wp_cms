<?php
$this->title = yii::t('article', 'page_title_article_update');
$this->description = yii::t('article', 'func_desc_article_update');
$this->params['breadcrumbs'][] = ['label' => Yii::t('article','page_title_article'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('_form', ['model' => $model,]);

