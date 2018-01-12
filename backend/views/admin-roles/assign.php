<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2016-04-11 22:34
 */

/**
 * @var $this yii\web\View
 */

use backend\widgets\ActiveForm;
use common\widgets\JsBlock;
use backend\assets\JstreeAsset;


JstreeAsset::register($this);


?>
<div id="addForm">
    <div class="ibox-content">
        <div class="form-group">
            <div class="col-sm-2 control-label" style="text-align: right">角色组名称:</div>
            <div class="col-xs-10"><b><?= yii::t('menu', $role_name) ?></b></div>
        </div>

        <div class="hr-line-dashed"></div>

        <div class="form-group">
            <div class="col-sm-2 control-label" style="text-align: right">权限设置:</div>
            <div class="col-xs-10">
                <span class="text-muted">
                    <input type="checkbox" name id="checkall" /><label for="checkall">&nbsp;<small>选中全部</small></label>
                </span>&nbsp;&nbsp;&nbsp;&nbsp;
                <span class="text-muted">
                    <input type="checkbox" name id="expandall" /><label for="expandall">&nbsp;<small>选中全部</small></label>
                </span>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-2 control-label" style="text-align: right">&nbsp;</div>
            <div id="permission-tree" class="col-xs-10"></div>
        </div>
        <span style="margin-top:20px ">&nbsp;</span>
        <?php $form = ActiveForm::begin() ?>

            <?= $form->defaultButtons() ?>
        <?php ActiveForm::end() ?>
    </div>
</div>


<?php JsBlock::begin() ?>
    <script>
        $.fn.yiiActiveForm = function(){}
        $(function () {
            $('#permission-tree').jstree({
                'core': {
                    'data': <?=$treeJson?>
                },
                "plugins": ["checkbox"]
            });

            $("form").submit(function () {
                var idArr = $('#permission-tree').jstree().get_checked();
                var ids = idArr.join(',');
                $("form").append("<input type='hidden' name='ids' value='" + ids + "'>");
            });
        });
    </script>
<?php JsBlock::end() ?>