<?php
/**
 * Author: gzzhaoxi@gmail.com
 */

namespace cmscore\assets;

use yii\web\AssetBundle;

class ActiveFormAsset extends AssetBundle
{
    public $sourcePath = '@yii/assets';
    public $js = [
        'yii.activeForm.js',
    ];
    public $depends = [
        'cmscore\assets\YiiAsset',
    ];
}
