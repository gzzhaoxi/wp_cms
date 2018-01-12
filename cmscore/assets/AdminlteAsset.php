<?php
/**
 * Author: gzzhaoxi@gmail.com
 */

namespace cmscore\assets;

use Yii;
use yii\base\Exception;
use yii\web\AssetBundle as BaseAdminLteAsset;

class AdminlteAsset extends BaseAdminLteAsset
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/dist';
    //public $sourcePath = '@vendor/';
    public $css = [
        //'css/AdminLTE.min.css',
        'css/adminlte-customer.css',
    ];
    public $js = [
        'js/app.min.js',//由于adminlte已升级,原mdm插件按老版本编写引用该JS文件,此处还需要调用
        'js/adminlte.min.js'
    ];
    public $depends = [
        'rmrevin\yii\fontawesome\AssetBundle',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

    //
    public $skin = 'skin-green';

    /**
     * @inheritdoc
     */
    public function init()
    {
        // Append skin color file if specified
        if ($this->skin) {
            if (('_all-skins' !== $this->skin) && (strpos($this->skin, 'skin-') !== 0)) {
                throw new Exception('Invalid skin specified');
            }

            //$this->css[] = sprintf('css/skins/%s.min.css', $this->skin);
            $this->css[] = sprintf('css/skins/%s.css', $this->skin);
        }

        parent::init();
    }


}
