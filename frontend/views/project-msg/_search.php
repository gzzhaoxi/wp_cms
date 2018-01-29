<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ProjectMsgSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-msg-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="form-group field-projectmsgsearch-msg">
    <table width="100%">
        <tr>
            <td><input id="projectmsgsearch-msg" class="form-control" name="ProjectMsgSearch[msg]" type="text" placeholder="keyword" value="<?=$keyword?>"></td>
            <td width="15"><?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?></td>
        </tr>
    </table>
        </div>
    <?php ActiveForm::end(); ?>

</div>
