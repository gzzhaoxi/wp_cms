<?php
/**
 * Author: gzzhaoxi@gmail.com
 */

namespace cmscore\assets;

use yii\web\AssetBundle;

class JqueryAsset extends AssetBundle
{
    public $sourcePath = '@bower/jquery/dist';
    public $js = [
        'jquery.js',
    ];
}
