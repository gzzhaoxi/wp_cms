<?php
/**
 * Author: gzzhaoxi@gmail.com
 */

namespace backend\grid;

class CheckboxColumn extends \yii\grid\CheckboxColumn
{

    public $width = '5px';
    public $headerOptions = ['style' => 'border-bottom: 1px solid #ddd;text-align:center;'];

    public function init()
    {
        parent::init();

        if (! isset($this->headerOptions['width'])) {
            $this->headerOptions['width'] = $this->width;
        }
        $this->contentOptions = ['style' => 'vertical-align: middle; text-align:center;'];

    }

}