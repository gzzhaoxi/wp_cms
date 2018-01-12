<?php
/**
 * Author: gzzhaoxi@gmail.com
 */

namespace backend\grid;

use common\libs\Constants;

class StatusColumn extends DataColumn
{

    public $attribute = 'status';
    public $headerOptions = ['width' => '25px'];

    public function init()
    {
        parent::init();
        $this->contentOptions = ['class' => 'align-center'];
        $this->content = function ($model, $key, $index, $gridView) {
            return Constants::getDisplayItems($model->is_display);
        };
    }
}