<?php
$this->title = yii::t('ads', 'page_title_ads_update');
$this->description = yii::t('ads', 'func_desc_ads_update');
$this->params['breadcrumbs'][] = ['label' => Yii::t('ads','page_title_ads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('_form', ['model' => $model,]);

