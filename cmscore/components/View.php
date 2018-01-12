<?php
/**
 * Author: gzzhaoxi@gmail.com
 */

namespace cmscore\components;

use cmscore\assets\JqueryAsset;

class View extends \yii\web\View
{
    //
    public $description = 'Default System Functions Description.（Tips：标签设置位置cmscore\components\View.php)';

    //
    public function registerJs($js, $position = self::POS_READY, $key = null)
    {
        $key = $key ? : md5($js);
        $this->js[$position][$key] = $js;
        if ($position === self::POS_READY || $position === self::POS_LOAD) {
            JqueryAsset::register($this);
        }
    }

}