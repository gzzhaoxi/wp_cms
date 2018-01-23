<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%member}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $real_name
 * @property integer $mobile
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Member extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%member}}';
    }
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password'],'required', 'on' => ['create']],
            [['username'],'required', 'on' => ['update']],
            [['username'], 'string', 'max' => 50],
            [['mobile'], 'string', 'max' => 20],
            [['password'], 'string', 'max' => 100],
            [['real_name', 'email'], 'string', 'max' => 200],
        ];
    }
    public function scenarios()
    {
        return [
            'default' => ['username', 'email'],
            'create' => ['username', 'email', 'password', 'mobile','real_name', 'status'],
            'update' => ['username', 'email', 'password', 'mobile','real_name',  'status'],
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
            'password' => Yii::t('app', 'pub_password'),
            'real_name' => Yii::t('app', 'pub_linkman'),
            'mobile' => Yii::t('app', 'pub_phone'),
            'email' => Yii::t('app', 'pub_email'),
            'status' => Yii::t('app', 'pub_status'),
            'created_at' => Yii::t('app', 'pub_created_at'),
            'updated_at' => Yii::t('app', 'pub_updated_at'),
        ];
    }
}
