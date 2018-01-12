<?php
/**
 * Author: gzzhaoxi@gmail.com
 */

namespace backend\grid;

use yii;
use yii\helpers\ArrayHelper;
use yii\widgets\LinkPager;
use cmscore\assets\GridViewAsset;
use yii\helpers\Json;
use yii\widgets\BaseListView;

class GridView extends \yii\grid\GridView
{
    public $dataColumnClass = DataColumn::class;
    //public $pager = ['class'=>'source\core\widgets\AdminLinkPager'];
    //fixed-table-header
    public $options = ['class' => 'fixed-table-container', 'style' => 'margin-right: 0px; '];
    public $tableOptions = ['class' => 'table table-striped table-bordered table-hover', 'width' => '100%',];
    public $layout = "{items}\n{pager}";
    public $pagerOptions = [
        'firstPageLabel' => '首页',
        'lastPageLabel' => '尾页',
        'prevPageLabel' => '上一页',
        'nextPageLabel' => '下一页',
        'options' => [
            'class' => 'pagination',
        ],
    ];

    public $filterRow;

    public function init()
    {
        parent::init();

        $this->rowOptions = function ($model, $key, $index, $grid) {
            if ($index % 2 === 0) {
                return ['class' => 'odd'];
            } else {
                return ['class' => 'even'];
            }
        };
        $this->pagerOptions = [
            'firstPageLabel' => yii::t('app', 'pagination_first'),
            'lastPageLabel' => yii::t('app', 'pagination_last'),
            'prevPageLabel' => yii::t('app', 'pagination_previous'),
            'nextPageLabel' => yii::t('app', 'pagination_next'),
            'options' => [
                'class' => 'pagination',
            ]
        ];
    }

    public function renderTableRow($model, $key, $index)
    {
        if ($this->filterRow !== null && call_user_func($this->filterRow, $model, $key, $index, $this) === false) {
            return '';
        }
        return parent::renderTableRow($model, $key, $index);
    }

    public function renderPager()
    {
        $pagination = $this->dataProvider->getPagination();
        if ($pagination === false || $this->dataProvider->getCount() <= 0) {
            return '';
        }
        /* @var $class LinkPager */
        $pager = $this->pager;
        $class = ArrayHelper::remove($pager, 'class', LinkPager::className());
        $pager['pagination'] = $pagination;
        $pager['view'] = $this->getView();
        $pager = array_merge($pager, $this->pagerOptions);
        return $class::widget($pager);
    }

    public function run()
    {
        $id = $this->options['id'];
        $options = Json::htmlEncode($this->getClientOptions());
        $view = $this->getView();
        GridViewAsset::register($view);
        $view->registerJs("jQuery('#$id').yiiGridView($options);");
        BaseListView::run();
    }
}