<?php
namespace common\components;

use Yii;
use linslin\yii2\curl;
use yii\helpers\Json;
use common\models\IsAreas;
use common\models\SdbSuppliersItem;
use yii\web\Request;
use yii\base\Object;
use Symfony\Component\CssSelector\Node\SelectorNode;

class Helper
{
    /**返回ajax处理结果
     *
     * @param number $status
     * @param string $msg
     * @param string $data
     */
    public static function ajaxReturn($data)
    {
        echo Json::encode($data);
        exit();
    }
    
    public static function ajaxStatus($error = 0, $msg = '', $data = '') {
        self::ajaxReturn(['error' => $error, 'msg' => $msg, 'data' => $data]);
    }

    public static function ajax_return($status = 0, $msg = '', $data = '')
    {
        echo Json::encode(['status' => $status, 'msg' => $msg, 'content' => $data]);
        exit();
    }
}