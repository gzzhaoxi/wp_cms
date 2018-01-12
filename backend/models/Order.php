<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\base\InvalidParamException;
use common\libs\Constants;

class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'appointed_at', 'is_fire', 'customer_id', 'sales_id', 'project_id', 'address_id', 'status_pay', 'status_confirm', 'status_send', 'express_type', 'remark'], 'integer'],
            [['prepay_amount', 'unpay_amount', 'free_amount', 'discount', 'express_cost'], 'number'],
            [['produce_content'], 'string'],
            [['order_no'], 'string', 'max' => 20],
            [['express_code'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'                => Yii::t('app', 'pub_list_id'),
            'created_at'        => Yii::t('app', 'pub_created_at'),
            'updated_at'        => Yii::t('app', 'pub_updated_at'),
            'customer_id'       => Yii::t('app', 'customer_id'),
            'order_no'          => Yii::t('app', 'order_no'),
            'sales_id'          => Yii::t('app', 'sales_id'),
            'project_id'        => Yii::t('app', 'project_id'),
            'address_id'        => Yii::t('app', 'receiver_id'),
            'prepay_amount'     => Yii::t('app', 'pre_payment_amount'),
            'unpay_amount'      => Yii::t('app', 'un_pay_amount'),
            'free_amount'       => Yii::t('app', 'free_pay_amount'),
            'discount'          => Yii::t('app', 'discount'),
            'express_cost'      => Yii::t('app', 'express_cost'),
            'status_pay'        => Yii::t('app', 'status_pay'),
            'status_confirm'    => Yii::t('app', 'status_confirm'),
            'status_send'       => Yii::t('app', 'status_send'),
            'express_type'      => Yii::t('app', 'express_type'),
            'express_code'      => Yii::t('app', 'express_code'),
            'produce_content'   => Yii::t('app', 'produce_content'),
            'remark'            => Yii::t('app', 'pub_remark'),
            'appointed_at'      => Yii::t('app', 'appointed_at'),
            'is_fire'           => Yii::t('app', 'is_fire'),
        ];
    }
}
