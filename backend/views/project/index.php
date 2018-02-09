<?php

use backend\grid\GridView;
use common\widgets\Pjax;

use backend\grid\CheckboxColumn;
use backend\grid\ActionColumn;
use backend\widgets\Bar;
use yii\helpers\Url;
use common\libs\Constants;
use yii\Helpers\Html;
use common\widgets\JsBlock;

$this->title = yii::t('project', 'page_title_project_list');
$this->description = yii::t('project', 'func_desc_project');
$this->params['breadcrumbs'][] = ['label' => Yii::t('project','page_title_project'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<!-- ./common buttons start -->
<div id="toolbar" class="toolbar">

    <!-- ./left buttons -->
    <?= Bar::widget(['template' => '{refresh} {delete}'])?>


    <?php  echo $this->render('_search', ['model'=>$searchModel]); ?>
</div>
<!-- ./common buttons end -->

<?php Pjax::begin(['id' => 'pjax']); ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    //'filterModel' => $searchModel,
    'layout' => "{items}\n{pager}",
    'columns' => [
        [
            'class' => CheckboxColumn::class,
        ],
        [
            'attribute' => 'name',
        ],
        [
            'attribute' => 'photo',
            'format' => 'raw',
            'value' => function($model){
                $src =  Yii::$app->params['web_url'].$model->photo;

                return Html::img($src,['style'=>'width:50px;height:50px']);
            }
        ],

        [
            'attribute' => 'office_name',
        ],

        [
            'attribute' => 'hit',
        ],
        [
            'attribute' => 'msg_count',
            'format' => 'raw',
            'value' => function($model){
                $num = \backend\models\ProjectMsg::find()->where(['project_id'=>$model->id])->count();
                return Html::a($num,'/project-msg?project_id='.$model->id,['style'=>'text-decoration:underline']);
            }
        ],
        [
            'attribute' => 'user.username',
        ],
        [
            'attribute' => 'created_at',
            'format' => 'date',
            'width' => '70px',
        ],
        [
            'attribute' => 'updated_at',
            'format' => 'date',
            'width' => '70px',
        ],
        [
            'class' => ActionColumn::class,
            'width' => '60px',
            'template' => ' {update} {delete}',
        ]
    ],
]); ?>
<?php Pjax::end();?>

<?php JsBlock::begin() ?>
<script>

</script>
<?php JsBlock::end();?>
