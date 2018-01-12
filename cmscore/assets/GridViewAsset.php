<?php
/**
 * Author: gzzhaoxi@gmail.com
 */

namespace cmscore\assets;

use yii\web\AssetBundle;

class GridViewAsset extends AssetBundle
{
    public $sourcePath = '@yii/assets';
    public $js = [
        'yii.gridView.js',
    ];
    public $depends = [
        'cmscore\assets\YiiAsset',
    ];
}
