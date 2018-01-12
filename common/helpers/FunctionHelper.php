<?php
/**
 * Created by PhpStorm.
 * User: gzzhaoxi@gmail.com
 * Date: 2017/11/17
 * Time: 16:07
 */
namespace common\helpers;

use yii;

class FunctionHelper
{
    //
    public static function getRandNumber($min, $max){
        return mt_rand($min, $max);
    }

}