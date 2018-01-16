<?php
/**
 * Author: gzzhaoxi@gmail.com
 */

namespace backend\widgets;

use yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;

class Bar extends Widget
{
    public $buttons = [];
    public $options = [
        //'class' => 'mail-tools tooltip-demo m-t-md',
        'class' => 'bs-bars pull-left',
    ];
    public $template = "{refresh} {create} {update} {sort} {delete}";

    public function run()
    {
        $buttons = '';
        $this->initDefaultButtons();
        $buttons .= $this->renderDataCellContent();
        /*
        ActiveForm::begin([
            'action' => Url::to(['sort']),
            'options' => ['class' => 'form-horizontal', 'name' => 'sort']
        ]);
        ActiveForm::end();
        */
        //return "<div class='{$this->options['class']}'>{$buttons}</div>";
        return "<div class='{$this->options['class']}'>
                    <div id='toolbar' class='toolbar'>{$buttons}</div>
                </div>";
    }

    protected function renderDataCellContent()
    {
        return preg_replace_callback('/\\{([\w\-\/]+)\\}/', function ($matches) {
            $name = $matches[1];
            if (isset($this->buttons[$name])) {
                return $this->buttons[$name] instanceof \Closure ? call_user_func($this->buttons[$name]) : $this->buttons[$name];
            } else {
                return '';
            }


        }, $this->template);
    }

    protected function initDefaultButtons()
    {
        if (! isset($this->buttons['refresh'])) {
            $this->buttons['refresh'] = function () {//刷新不需要文字说明 yii::t('app', 'Refresh') Url::to(['refresh'])
                return Html::a('<i class="fa fa-refresh"></i> ' . '', 'javascript:void(0);', [
                    'title' => yii::t('app', 'btn_bar_refresh'),
                    'data-pjax' => '0',
                    'class' => 'btn btn-primary btn-refresh',
                    'onclick' => 'location.reload()',
                ]);
            };
        }

        if (! isset($this->buttons['create'])) {
            $this->buttons['create'] = function () {
                return Html::a('<i class="fa fa-plus"></i> ' . yii::t('app', 'btn_bar_create'), Url::to(['create']), [
                    'title' => yii::t('app', 'btn_bar_create'),
                    'data-pjax' => '0',
                    'class' => 'btn btn-success btn-add',
                ]);
            };
        }

        //ajax新增弹窗方式应用
        //调公共js function中的onCreate方法
        //需要在应用页面javascrtip中定义URL
        //标题默认为控件本身属性中的:title
        if (! isset($this->buttons['create-layer'])) {
            $this->buttons['create-layer'] = function () {
                return Html::a('<i class="fa fa-plus"></i> ' . yii::t('app', 'btn_bar_create'), 'javascript:;',
                    [
                        'title' => yii::t('app', 'btn_bar_create'),
                        'onClick' => "onCreate($(this))",
                        'class' => 'btn btn-success btn-add',
                    ]);
            };
        }

        if (! isset($this->buttons['update'])) {
            $this->buttons['update'] = function () {
                return Html::a('<i class="fa fa-pencil"></i> ' . yii::t('app', 'btn_bar_update'), Url::to(['update']), [
                    'title' => yii::t('app', 'btn_bar_update'),
                    'data-pjax' => '0',
                    'class' => 'btn btn-info disabled',
                ]);
            };
        }

        if (! isset($this->buttons['sort'])) {
            $this->buttons['sort'] = function () {
                return Html::a('<i class="fa  fa-sort-numeric-desc"></i> ' . yii::t('app', 'Sort'), Url::to(['sort']), [
                    'title' => yii::t('app', 'Sort'),
                    'data-pjax' => '0',
                    'class' => 'btn btn-white btn-sm sort',
                ]);
            };
        }

        if (! isset($this->buttons['delete'])) {
            $this->buttons['delete'] = function () {
                return Html::a('<i class="fa fa-trash-o"></i> ' . yii::t('app', 'btn_bar_delete'), Url::to(['delete']), [
                    'title' => yii::t('app', 'btn_bar_delete'),
                    'data-pjax' => '0',
                    'class' => 'btn btn-danger btn-del btn-disabled disabled',
                ]);
            };
        }
    }
}