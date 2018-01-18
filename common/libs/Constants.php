<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2016-10-16 17:15
 */

namespace common\libs;

use yii;
use yii\base\InvalidParamException;

class Constants
{
    //是否删除
    const DELETE_YES = 1;
    const DELETE_NO = 0;

    //状态:1正常 2禁用
    const STATUS_NORMAL = 1;
    const STATUS_BREAK = 2;
    const STATUS_DISABLED = 3;

    public static function getStatus($key = null){
        $arr_status = [
            self::STATUS_NORMAL => yii::t('app', 'pub_status_normal'),
            self::STATUS_BREAK  =>  yii::t('app', 'pub_status_break'),
            self::STATUS_DISABLED => yii::t('app', 'pub_status_disabled'),
        ];
        return self::getItems($arr_status, $key);
    }

    //是否状态: 1是 0否
    const YesNo_Yes = 1;
    const YesNo_No = 0;

    public static function getYesNoItems($key = null)
    {
        $items = [
            self::YesNo_Yes => yii::t('app', 'pub_yes'),
            self::YesNo_No => yii::t('app', 'pub_no'),
        ];
        return self::getItems($items, $key);
    }

    //网站分类类型设置
//    const CATEGORY_TYPE_PROD = 1; //产品分类
//    const CATEGORY_TYPE_SERVICE = 2; //服务信息分类
//    const CATEGORY_TYPE_ARTICLE = 3; //媒体资讯分类
//    const CATEGORY_TYPE_STOCK = 4; //库存分类
//    const CATEGORY_TYPE_PROVIDE = 5; //供应商分类
//    const CATEGORY_TYPE_HR = 6; //人事分类
//    const CATEGORY_TYPE_EQUIPMENT = 7; //设备分类
//
//    public static function getTopCategory( $key = null ) {
//        $items = [
//            self::CATEGORY_TYPE_PROD      => yii::t('app', 'const_category_prod'),
//            self::CATEGORY_TYPE_SERVICE   => yii::t('app', 'const_category_service'),
//            self::CATEGORY_TYPE_ARTICLE   => yii::t('app', 'const_category_article'),
//            self::CATEGORY_TYPE_STOCK     => yii::t('app', 'const_category_stock'),
//            self::CATEGORY_TYPE_PROVIDE   => yii::t('app', 'const_category_provide'),
//            self::CATEGORY_TYPE_HR        => yii::t('app', 'const_category_hr'),
//            self::CATEGORY_TYPE_EQUIPMENT => yii::t('app', 'const_category_equipment'),
//        ];
//        return self::getItems($items, $key);
//    }

    //网站分类类型设置
    const CATEGORY_TYPE_ARTICLE = 1; //文章/资讯分类
    const CATEGORY_TYPE_ADS = 2;   //广告分类
    public static function getTopCategory( $key = null ) {
        $items = [
            self::CATEGORY_TYPE_ARTICLE      => yii::t('article', 'const_category_article'),
            self::CATEGORY_TYPE_ADS   => yii::t('article', 'const_category_ads'),
        ];
        return self::getItems($items, $key);
    }

    //生产工艺配置信息
    const PRODUCTION_SIZE  = 1;//规格
    const PRODUCTION_PAPER = 2;//纸张
    const PRODUCTION_WEIGH = 3;//克重
    const PRODUCTION_PAGES = 4;//面数
    const PRODUCTION_UNIT  = 5;//单位
    const PRODUCTION_PRINT = 6;//打印方式

    public static function getProductionSetting( $key = null ){
        $items = [
            self::PRODUCTION_SIZE => yii::t('app', 'const_production_size'),
            self::PRODUCTION_PAPER => yii::t('app', 'const_production_paper'),
            self::PRODUCTION_WEIGH => yii::t('app', 'const_production_weigh'),
            self::PRODUCTION_PAGES => yii::t('app', 'const_production_pages'),
            self::PRODUCTION_UNIT  => yii::t('app', 'const_production_unit'),
            self::PRODUCTION_PRINT  => yii::t('app', 'const_production_print'),
        ];
        return self::getItems($items, $key);
    }

    //
    const BACKEND_TYPE = 0;
    const FRONTEND_TYPE = 1;

    public static function getMenuType($key = null){
        $items = [
            self::BACKEND_TYPE  => yii::t('menu', 'const_menu_type_backend'),
            self::FRONTEND_TYPE => yii::t('menu', 'const_menu_type_frontend'),
        ];

        //
        return self::getItems($items, $key);
    }

//----------------------------------------------------------------------------------------------//


    public static function getWebsiteStatusItems($key = null)
    {
        $items = [
            self::YesNo_Yes => yii::t('app', 'Opened'),
            self::YesNo_No => yii::t('app', 'Closed'),
        ];
        return self::getItems($items, $key);
    }

    const COMMENT_INITIAL = 0;
    const COMMENT_PUBLISH = 1;
    const COMMENT_RUBISSH = 2;

    public static function getCommentStatusItems($key = null)
    {
        $items = [
            self::COMMENT_INITIAL => yii::t('app', 'Not Audited'),
            self::COMMENT_PUBLISH => yii::t('app', 'Passed'),
            self::COMMENT_RUBISSH => yii::t('app', 'Unpassed'),
        ];
        return self::getItems($items, $key);
    }

    const TARGET_BLANK = '_blank';
    const TARGET_SELF = '_self';

    public static function getTargetOpenMethod($key = null)
    {
        $items = [
            self::TARGET_BLANK => yii::t('app', 'Yes'),
            self::TARGET_SELF => yii::t('app', 'No'),
        ];
        return self::getItems($items, $key);
    }


    const HTTP_METHOD_ALL = 0;
    const HTTP_METHOD_GET = 1;
    const HTTP_METHOD_POST = 2;

    public static function getHttpMethodItems($key = null)
    {
        $items = [
            self::HTTP_METHOD_ALL => 'all',
            self::HTTP_METHOD_GET => 'get',
            self::HTTP_METHOD_POST => 'post',
        ];
        return self::getItems($items, $key);
    }

    const PUBLISH_YES = 1;
    const PUBLISH_NO = 0;

    public static function getArticleStatus($key = null)
    {
        $items = [
            self::PUBLISH_YES => yii::t('app', 'Publish'),
            self::PUBLISH_NO => yii::t('app', 'Draft'),
        ];
        return self::getItems($items, $key);
    }

    const INPUT_INPUT = 1;
    const INPUT_TEXTAREA = 2;
    const INPUT_UEDITOR = 3;

    public static function getInputTypeItems($key = null)
    {
        $items = [
            self::INPUT_INPUT => 'input',
            self::INPUT_TEXTAREA => 'textarea',
            self::INPUT_UEDITOR => 'ueditor',
        ];
        return self::getItems($items, $key);
    }

    const ARTICLE_VISIBILITY_PUBLIC = 1;
    const ARTICLE_VISIBILITY_COMMENT = 2;
    const ARTICLE_VISIBILITY_SECRET = 3;

    public static function getArticleVisibility($key = null)
    {
        $items = [
            self::ARTICLE_VISIBILITY_PUBLIC => yii::t('app', 'Public'),
            self::ARTICLE_VISIBILITY_COMMENT => yii::t('app', 'Reply'),
            self::ARTICLE_VISIBILITY_SECRET => yii::t('app', 'Password'),
        ];
        return self::getItems($items, $key);
    }



    private static function getItems($items, $key = null)
    {
        if ($key !== null) {
            if (key_exists($key, $items)) {
                return $items[$key];
            }
            throw new InvalidParamException( 'Unknown key:' . $key );
        }
        return $items;
    }
}
