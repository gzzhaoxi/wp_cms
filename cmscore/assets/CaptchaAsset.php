<?php
/**
 * Author: gzzhaoxi@gmail.com
 */

namespace cmscore\assets;

class CaptchaAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@yii/assets';
    public $js = [
        'yii.captcha.js',
    ];
    public $depends = [
        'cmscore\assets\YiiAsset',
    ];
}