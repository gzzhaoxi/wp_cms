<?php
/**
 * Author: gzzhaoxi@gmail.com
 */

namespace backend\grid;

use Yii;
use Closure;
use yii\helpers\Html;
use yii\helpers\Url;

class ActionColumn extends \yii\grid\ActionColumn
{

    public $header = '';
    public $queryParams = [];

    public $width = '30px';
    public $headerOptions = ['style' => 'text-align:center; border-bottom: 1px solid #ddd'];
    public $template = '{update} {delete}';

    public function init()
    {
        parent::init();
        $this->header = yii::t('app', 'pub_table_head_action');
        if (! isset($this->headerOptions['width'])) {
            $this->headerOptions['width'] = $this->width;
        }

        $this->contentOptions = ['class' => 'da-icon-column', 'style' => 'width:' . $this->width . ';'];
    }

    /*
     * 表单操作栏按钮定义
     * 定义为[X-layer]的按钮均为ajax应用,使用layer框架
     * 定义为[X]的按钮均为传统页面跳转式表单应用
     */
    protected function initDefaultButtons()
    {
        //传统页面跳转应用
        if (! isset($this->buttons['view'])) {
            $this->buttons['view'] = function ($url, $model, $key, $index, $gridView) {
                return Html::a('<i class="fa fa-eye"></i> ' , $url, [//. Yii::t('yii', 'View')
                    'title' => Yii::t('app', 'btn_bar_view'),
                    'data-pjax' => '0',
                    'class' => 'btn btn-primary btn-xs',
                ]);
            };
        }
        if (! isset($this->buttons['update'])) {
            $this->buttons['update'] = function ($url, $model, $key, $index, $gridView) {
                return Html::a('<i class="fa fa-pencil"></i> ' , $url, [//. Yii::t('app', 'Update')
                    'title' => Yii::t('app', 'btn_bar_update'),
                    'data-pjax' => '0',
                    'class' => 'btn btn-info btn-xs',
                ]);
            };
        }
        if (! isset($this->buttons['delete'])) {
            $this->buttons['delete'] = function ($url, $model, $key, $index, $gridView) {//. Yii::t('app', 'Delete')
                return Html::a('<i class="glyphicon glyphicon-trash" aria-hidden="true"></i> ' , $url, [
                    'title' => Yii::t('app', 'btn_bar_delete'),
                    'data-confirm' => Yii::t('app', 'pub_confirm_delete'),
                    'data-method' => 'post',
                    'data-pjax' => '0',
                    'class' => 'btn btn-danger btn-delone btn-xs',

                ]);
            };
        }

        //ajax应用
        if (! isset($this->buttons['view-layer'])) {
            $this->buttons['view-layer'] = function ($url, $model, $key, $index, $gridView) {
                //$url = str_replace('viewLayer', 'view', $url);
                return Html::a('<i class="fa fa-eye"></i> ', 'javascript:void(0);', [
                    'title' => Yii::t('app', 'btn_bar_detail'),
                    'onclick' => "onDetail('" . $url . "',$(this))",
                    'data-pjax' => '0',
                    'class' => 'btn btn-primary btn-xs',
                ]);
            };
        }

        if(! isset($this->buttons['update-layer'])){
            $this->buttons['update-layer'] = function($url, $model, $key){
                return Html::a('<i class="fa  fa-pencil" aria-hidden="true"></i> ', 'javascript:;', [
                    'title' => Yii::t('app', 'btn_bar_update'),
                    'onclick' => 'onUpdate('.$model['id'].',$(this))',
                    'data-pjax' => '0',
                    'class' => 'btn btn-info btn-xs',
                ]);
            };
        }


        /* 通用性较差
        if(isset($this->buttons['create'])){
            //
            $this->buttons['create'] = function ($url, $model, $key, $index, $gridView) {//. Yii::t('app', 'Delete')
                return Html::a('<i class="fa fa-plus" aria-hidden="true"></i> ', $url, [
                    'title' => Yii::t('app', 'Create'),
                    'data-pjax' => '0',
                    'class' => 'btn btn-success btn-xs btn-add',
                    'style' => 'margin-right:5px',
                ]);
            };
        }
        */
    }

    public function createUrl($action, $model, $key, $index)
    {
        if ($this->urlCreator instanceof Closure) {
            return call_user_func($this->urlCreator, $action, $model, $key, $index, $this);
        } else {
            $params = \Yii::$app->request->queryParams;
            if (is_array($key)) {
                $params = array_merge($params, $key);
            } else {
                $params['id'] = (string)$key;
            }
            if (isset($this->queryParams[$action])) {
                $params = array_merge($params, $this->queryParams[$action]);
            }
            $params[0] = $this->controller ? $this->controller . '/' . $action : $action;

            return Url::toRoute($params);
        }
    }

    /**
     * @inheritdoc
     */
    protected function renderDataCellContent($model, $key, $index)
    {
        if ($this->content !== null) {
            return call_user_func($this->content, $model, $key, $index, $this);
        }

        return preg_replace_callback('/\\{([\w\-\/]+)\\}/', function ($matches) use ($model, $key, $index) {
            $name = $matches[1];
            if (isset($this->buttons[$name])) {
                $url = $this->createUrl($name, $model, $key, $index);

                return call_user_func($this->buttons[$name], $url, $model, $key, $index, $this);
            } else {
                return '';
            }
        }, $this->template);
    }
}