<?php
/**
 * Author: gzzhaoxi@gmail.com
 */

namespace cmscore\assets;

use yii\web\AssetBundle;

class PjaxAsset extends AssetBundle
{
    public $sourcePath = '@bower/yii2-pjax';
    public $js = [
        'jquery.pjax.js',
    ];
    public $depends = [
        'cmscore\assets\YiiAsset',
    ];
}
