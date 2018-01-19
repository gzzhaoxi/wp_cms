<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'static/asset/css/bootstrap.min.css',
        'static/css/font-awesome.min.css',
        'static/css/animate.css',
        'static/css/owl.carousel.css',
        'static/css/owl.theme.css',
        'static/css/owl.transitions.css',
        'static/css/style.css',
        'static/css/responsive.css',
        'static/css/color/light-blue.css',
        'http://fonts.googleapis.com/css?family=Kaushan+Script',
    ];
    public $js = [
        'static/js/modernizr.custom.js',
        'static/js/jquery-2.1.1.min.js',
        'static/asset/js/bootstrap.min.js',
        'static/js/jquery.easing.1.3.js',
        'static/js/classie.js',
        'static/js/count-to.js',
        'static/js/jquery.appear.js',
        'static/js/cbpAnimatedHeader.js',
        'static/js/owl.carousel.min.js',
        'static/js/jquery.fitvids.js',
        'static/js/styleswitcher.js',
        'static/js/jqBootstrapValidation.js',
        'static/js/script.js',
    ];
    public $depends = [
//         'yii\web\YiiAsset',
//         'yii\bootstrap\BootstrapAsset',
    ];
}
