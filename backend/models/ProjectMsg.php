<?php
/**
 * Created by PhpStorm.
 * User: yanxs
 * Date: 2018/1/26
 * Time: 14:18
 */

namespace backend\models;


class ProjectMsg extends \common\models\ProjectMsg
{
    /**
     * 关联用户表
     * @return \yii\db\ActiveQuery
     */
    public function getUser(){
        return $this->hasOne(User::className(),['id'=>'user_id']);
    }
    /**
     * 关联用户表
     * @return \yii\db\ActiveQuery
     */
    public function getProjects(){
        return $this->hasOne(Projects::className(),['id'=>'project_id']);
    }
}