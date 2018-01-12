<?php
/**
 * Author: gzzhaoxi@gmail.com
 */

namespace cmscore\components;

use Yii;


class Skinset
{
    public static function skinClass()
    {
        /** @var \dmstr\web\AdminLteAsset $bundle */
        $bundle = Yii::$app->assetManager->getBundle('cmscore\assets\AdminlteAsset');

        return $bundle->skin;
        //return AdminlteAsset::$skin;
    }

    public static function getThemePath(){
        return Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
    }
}