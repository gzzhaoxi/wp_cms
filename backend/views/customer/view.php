<?php

use backend\grid\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\customer */


?>
<div id="detailsForm">
    <div class="ibox-content">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'serial_no',
            'name',
            'nickname',
            'status',
            'level',
            'sales_id',
            'recommend_id',
            'type',
            'trade_type',
            'linkman',
            'tel',
            'mobile',
            'qq',
            [
                'attribute' => 'address',
                'format' => 'raw',
                'value' => \common\models\Region::getRegionName([$model['province'],$model['city'],$model['district']]).$model['address']
            ],
            [
                'attribute' => 'created_at',
                'format' => ['date'],
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date'],
            ]
        ],
    ]) ?>
    </div>
</div>
