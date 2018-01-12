<?php
/**
 * Created by PhpStorm.
 * User: gzzhaoxi@gmail.com
 * Date: 2018/1/5
 * Time: 11:28
 */

namespace cmscore\assets;

use yii\web\AssetBundle;
/**
 * ~~~
 * use light\assets\LayerAsset;
 *
 * LayerAsset::register($this);
 * ~~~
 * @version 0.1.2
 * @author light-li<light-li@hotmail.com>
 */
class LayeruiAsset extends AssetBundle
{
    public $sourcePath = '@vendor/light/yii2-layerui/layui';

    public $js = ['layui.js'];

    public $css = ['css/layui.css'];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}