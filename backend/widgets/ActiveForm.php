<?php
/**
 * Author: gzzhaoxi@gmail.com
 */

namespace backend\widgets;

use Yii;
use yii\helpers\Html;
use yii\helpers\Json;
use cmscore\assets\ActiveFormAsset;

class ActiveForm extends \yii\widgets\ActiveForm
{

    public $options = [
        //'class' => 'form-horizontal'
        'class' => 'form-horizontal'
    ];

    public $fieldClass = 'backend\widgets\ActiveField';

    public function defaultButtons(array $options = [])
    {
        //<button class="layui-btn" lay-submit lay-filter="formDemo">' . Yii::t('app', 'btn_save') . '</button>
        //<button class="btn btn-primary" type="button" onClick="return submitForm()">' . Yii::t('app', 'btn_save') . '</button>
        $options['size'] = isset($options['size']) ? $options['size'] : 4;

        /*
        if($options['isAjax']){
            echo '<div class="form-group">
                  <div class="col-sm-' . $options['size'] . ' col-sm-offset-2">
                      <button class="btn btn-primary" type="button" onClick="return submitForm()" data-pjax="pjax">' . Yii::t('app', 'btn_save') . '</button>
                      <button class="btn btn-white" type="reset">' . Yii::t('app', 'btn_reset') . '</button>
                  </div>
              </div>';

        }else{
        */
            echo '<div class="form-group">
                  <div class="col-sm-' . $options['size'] . ' col-sm-offset-2">
                      <button class="btn btn-primary" type="submit">' . Yii::t('app', 'btn_save') . '</button>
                      <button class="btn btn-default btn-embossed" type="reset">' . Yii::t('app', 'btn_reset') . '</button>
                  </div>
              </div>';
        //}
    }

    public function run()
    {
        if (! empty($this->_fields)) {
            throw new InvalidCallException('Each beginField() should have a matching endField() call.');
        }

        $content = ob_get_clean();
        echo Html::beginForm($this->action, $this->method, $this->options);
        echo $content;

        if ($this->enableClientScript) {
            $id = $this->options['id'];
            $options = Json::htmlEncode($this->getClientOptions());
            $attributes = Json::htmlEncode($this->attributes);
            $view = $this->getView();
            ActiveFormAsset::register($view);
            $view->registerJs("jQuery('#$id').yiiActiveForm($attributes, $options);");
        }

        echo Html::endForm();
    }
}
