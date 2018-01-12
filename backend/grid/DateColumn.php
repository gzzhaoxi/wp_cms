<?php
/**
 * Author: gzzhaoxi@gmail.com
 */

namespace backend\grid;

class DateColumn extends DataColumn
{
    public $headerOptions = ['width' => '120px'];

    public $format = ['datetime', 'php:Y-m-d H:m:s'];

    public function init()
    {
        parent::init();
    }
}