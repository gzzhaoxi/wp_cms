<?php
/**
 * Created by PhpStorm.
 * User: yanxs
 * Date: 2018/1/25
 * Time: 17:24
 */

namespace backend\models;


class Projects extends \common\models\Projects
{
    public $msg_count;
    /**
     * 关联用户表
     * @return \yii\db\ActiveQuery
     */
    public function getUser(){
        return $this->hasOne(User::className(),['id'=>'user_id']);
    }
}