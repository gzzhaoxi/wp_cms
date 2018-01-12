<?php
/**
 * Created by PhpStorm.
 * User: gzzhaoxi@gmail.com
 * Date: 2017/8/2
 * Time: 11:59
 */

namespace backend\grid;

class DetailView extends \yii\widgets\DetailView
{
    //
    public $template = '<tr><th style="width: 100px; text-align: right;">{label}</th><td{contentOptions}>{value}</td></tr>';

    public $options = ['class' => 'table table-striped  detail-view'];//table-bordered

    public function init()
    {
        parent::init();
    }
}