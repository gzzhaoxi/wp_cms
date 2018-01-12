<?php
/**
 * Author: gzzhaoxi@gmail.com
 */

namespace cmscore\assets;

use yii\web\AssetBundle;

class YiiAsset extends AssetBundle
{
    public $sourcePath = '@yii/assets';
    public $js = [
        'yii.js',
    ];
    public $depends = [
        'cmscore\assets\JqueryAsset',
    ];
}
