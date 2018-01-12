<?php

namespace backend\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    //public $basePath = '@webroot';
    //public $baseUrl = '@web';
    public $baseUrl = '@web/admin';
    public $sourcePath = '@backend/web/static';

    public $css = [
        //'css/site.css',
        'css/font-icon-style.css',//标题font图标
        'css/backend-style.css',
        //'css/plugins/sweetalert/sweetalert.css';
        //'js/plugins/sweetalert2/sweetalert2.min.css',
        //'js/plugins/sweetalert2/themes/facebook/facebook.css',
        'libs/bootstrap-table/dist/bootstrap-table.css',
        //'css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css',
    ];
    public $js = [
        'js/cms-backend-functions.js',
        //'js/plugins/sweetalert/sweetalert.min.js',
        //'js/plugins/sweetalert2/sweetalert2.min.js',
    ];

    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
        'cmscore\assets\YiiAsset',
        'cmscore\assets\BootstrapAsset',
        'cmscore\assets\AdminlteAsset',
        'cmscore\assets\LayeruiAsset',
        'cmscore\assets\LayerAsset',
    ];
}