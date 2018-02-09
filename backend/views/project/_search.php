<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\OrderSerach */
/* @var $form yii\widgets\ActiveForm */
?>

<style>
    .form-group {
        display: inline-block;
        margin-bottom: 0;
        vertical-align: middle;
        float: left;
    }
    .form-control {
        display: inline-block;
        vertical-align: middle;
        width: auto;
    }
</style>
<div class="pull-right search">
    <?php $form = ActiveForm::begin([
        'action' => ['/template/main/index'],
        'method' => 'get',
        'id'    => 'form-search'
    ]); ?>
    <fieldset>
        <div class="form-group" style="margin:5px">
            <label for="username" class="control-label" style="padding:0 10px;">项目名称</label>
            <input class="form-control" name="goods_name" value="" placeholder="商品名称" id="goods_name" type="text">
        </div>

        <div class="form-group" style="margin:5px">
            <div class="col-sm-12 text-center">
                <button type="submit" class="btn btn-success" style="background: #18bc9c">查询</button>
                <button type="reset" class="btn btn-default">重置</button>
            </div>
        </div>
    </fieldset>
    <?php ActiveForm::end(); ?>
</div>
<?php
$js = <<<JS
    $('#form-search').on('beforeSubmit', function(e) {
        var queryString = [];
        $('#form-search').find('input,select').each(function(){
            queryString.push($(this).attr('name') + '=' + $(this).val());
        });
        var url = $(this).attr('action') + '?' + queryString.join('&');
        $.pjax.reload({url: url, method: 'POST', container:'#pjax'});
    }).on('submit', function(e){                              
        e.preventDefault();                         
    });
    
JS;
$this->registerJs($js);
?>
