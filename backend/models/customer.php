<?php

namespace backend\models;

use Yii;
use common\helpers\FunctionHelper;
use yii\behaviors\TimestampBehavior;
use yii\base\InvalidParamException;
use yii\helpers\ArrayHelper;

class Customer extends \yii\db\ActiveRecord
{
    //
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%customer}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['serial_no', 'status', 'level', 'sales_id', 'recommend_id', 'type', 'trade_type', 'province', 'city', 'district', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['name', 'level', 'sales_id', 'linkman'], 'required'],
            [['nickname'], 'string', 'max' => 10],
            [['linkman', 'tel', 'mobile'], 'string', 'max' => 20],
            [['qq'], 'string', 'max' => 30],
            [['address'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'            => yii::t('app', 'pub_list_id'),
            'name'          => yii::t('app','pub_name'),
            'nickname'      => yii::t('app','pub_nickname'),
            'serial_no'     => yii::t('app','serial_no'),
            'status'        => yii::t('app','pub_status'),
            'level'         => yii::t('app','pub_level'),
            'sales_id'      => yii::t('app','sales_id'),
            'recommend_id'  => yii::t('app','recommend_id'),
            'type'          => yii::t('app','pub_type'),
            'trade_type'    => yii::t('app','trade_type'),
            'linkman'       => yii::t('app','pub_linkman'),
            'tel'           => yii::t('app','pub_phone'),
            'mobile'        => yii::t('app','pub_mobile'),
            'qq'            => yii::t('app','pub_qq'),
            'province'      => yii::t('app','pub_province'),
            'city'          => yii::t('app','pub_city'),
            'district'          => yii::t('app','pub_area'),
            'address'       => yii::t('app','pub_address'),
            'created_at'    => yii::t('app','pub_created_at'),
            'updated_at'    => yii::t('app','pub_updated_at'),
        ];
    }

    public function beforeSave($insert)
    {
        //
        if($insert){
           $this->serial_no = $this->generateSerialNo();
        }
        return parent::beforeSave($insert);
    }


    //返回客户编号
    //15位
    public function generateSerialNo()
    {
        return date('ymdhi').FunctionHelper::getRandNumber(10000, 99999);
    }

    //返回客户名称拼音首字母
    public static function getExchange(){
        //天津艺俪源云印刷科技有限公司
        //TJYYYYSKJYXGS
        $str = '获得';
        $rs =  \common\libs\Chinese2English::str2py($str);
        print_r($str.'<br>'.$rs);
        exit;
    }

    //
    public static function getCustomerInfo($id){
        if(!isset($id)) throw new InvalidParamException( 'Id is required:' . $id );
        return self::findOne(['id' => $id]);
    }

    //根据当前管理ID获取所对应负责的客户信息
    //如果是超管或管理员组对应ID：1或7的则检索出所有客户信息
    public static function getClientInfo(){
        //
        $curr_admin_role_id = AdminRoleUser::getRoleIdByUid();
        if(ArrayHelper::isIn($curr_admin_role_id, [AdminRoleUser::ROLE_FOR_ADMIN,AdminRoleUser::ROLE_FOR_SUPER])){
            $result = self::find()->asArray()->all();
        }else{
            $result = self::find()->where(['sales_id' => yii::$app->getUser()->getIdentity()->getId()])->asArray()->all();
        }

        if(is_array($result)){
            foreach($result as $item){
                $clientInfo[$item['id']] = $item['serial_no'].'    ('.$item['name'].')';
            }
        }

        return $clientInfo;
        //return ArrayHelper::map($result, 'id', 'serial_no');
    }
}
