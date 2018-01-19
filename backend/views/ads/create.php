<?php

$this->title = yii::t('ads', 'page_title_ads_create');
$this->description = yii::t('ads', 'func_desc_ads_create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('ads','page_title_ads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


echo $this->render('_form', ['model' => $model,]) ;
