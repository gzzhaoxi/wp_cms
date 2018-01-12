<?php
/**
 * Author: gzzhaoxi@gmail.com
 */

namespace backend\grid;

class DataColumn extends \yii\grid\DataColumn
{

    public $headerOptions = ['style' => 'text-align:center; border-bottom: 1px solid #ddd'];

    public $width = '60px';

    public function init()
    {
        parent::init();

        if (! isset($this->headerOptions['width'])) {
            $this->headerOptions['width'] = $this->width;
        }
        $this->contentOptions = ['style' => 'word-wrap: break-word; word-break: break-all; vertical-align: middle'];
    }
}