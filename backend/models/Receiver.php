<?php

namespace backend\models;

use common\libs\Constants;
use Yii;
use yii\behaviors\TimestampBehavior;

class Receiver extends \yii\db\ActiveRecord
{
    public $customer_name;
    //
    //public $district;

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
        return '{{%receiver}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'customer_id', 'province', 'city', 'district', 'zipcode', 'is_default', 'is_delete'], 'integer'],
            [['receiver_name', 'tel', 'address'], 'required'],
            [['receiver_name'], 'string', 'max' => 20],
            [['tel'], 'string', 'max' => 50],
            [['address', 'building'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'            => Yii::t('app', 'pub_list_id'),
            'created_at'    => Yii::t('app', 'pub_created_at'),
            'updated_at'    => Yii::t('app', 'pub_updated_at'),
            'customer_id'   => Yii::t('app', 'customer_id'),
            'receiver_name' => Yii::t('app', 'receiver_name'),
            'tel'           => Yii::t('app', 'pub_mobile').'/'.Yii::t('app', 'pub_phone'),
            'province'      => Yii::t('app', 'pub_province'),
            'city'          => Yii::t('app', 'pub_city'),
            'district'      => Yii::t('app', 'pub_area'),
            'address'       => Yii::t('app', 'pub_address'),
            'zipcode'       => Yii::t('app', 'pub_zipcode'),
            'building'      => Yii::t('app', 'pub_building'),
            'is_default'    => Yii::t('app', 'pub_is_default'),
            'is_delete'     => Yii::t('app', 'pub_is_delete'),
            'customer_name' => Yii::t('app', 'customer_id'),
        ];
    }

    //
    public static function getUserAddress($user_id){
        //
        if($user_id){
            $str_cond = ['customer_id' => $user_id, 'is_delete' => Constants::DELETE_NO];
        }

        $result = self::find()->where($str_cond)->asArray()->all();
            //->createCommand()->getRawSql();

        $arr_result = [];
        if($result){

            foreach($result as $item){
                if($item['is_default']) {
                    $arr_result['selected'] = $item['id'];
                }
                $arr_result['options'][$item['id']] = $item['receiver_name'].' '.\common\models\Region::getRegionName([$item['province'],$item['city'],$item['district']]).$item['address'];
            }
        }
        return $arr_result;
    }
}
