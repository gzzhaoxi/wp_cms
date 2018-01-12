<?php
$this->title = yii::t('app', 'page_title_order_index');
$this->description = yii::t('app', 'func_desc_order_index');

$this->params['breadcrumbs'] = [
    [
        'label' => $this->title,
        'url' => \yii\helpers\Url::toRoute(['order/index']),
    ],
    yii::t('app', 'page_title_order_create')
];


echo $this->render('_form', ['model' => $model,]);
