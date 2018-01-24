<?php
/**
 * Created by PhpStorm.
 * User: yanxs
 * Date: 2018/1/24
 * Time: 17:16
 */

namespace backend\models;

use yii;
class User extends \common\models\User
{
    public $password;

    public function rules()
    {
        return [
            [['password'], 'string', 'max' => 100],
            [['username', 'password'],'required', 'on' => ['create']],
            [['username'],'required', 'on' => ['update']],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }
    public function scenarios()
    {
        return [
            'default' => ['username', 'email'],
            'create' => ['username', 'email', 'password',  'status'],
            'update' => ['username', 'email', 'password',   'status'],
            'self-update' => ['username', 'email', 'password'],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'pub_account'),
            'auth_key' => Yii::t('app', 'auth_key'),
            'password_hash' => Yii::t('app', 'pub_password'),
            'password_reset_token' => Yii::t('app', 'password_reset_token'),
            'email' => Yii::t('app', 'pub_email'),
            'avatar' => Yii::t('app', 'pub_avatar'),
            'status' => Yii::t('app', 'pub_status'),
            'created_at' => Yii::t('app', 'pub_created_at'),
            'updated_at' => Yii::t('app', 'pub_updated_at'),
        ];
    }
    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if ($insert) {
            $this->generateAuthKey();
            $this->setPassword($this->password);
        } else {
            if (isset($this->password) && $this->password != '') {
                $this->setPassword($this->password);
            }
        }
        return parent::beforeSave($insert);
    }

}