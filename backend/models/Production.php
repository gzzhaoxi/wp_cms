<?php

namespace backend\models;

use Yii;

//
class Production extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%production}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code'], 'required'],
            [['code', 'type', 'status', 'created_at', 'updated_at', 'print_type', 'amount', 'pcs'], 'integer'],
            [['name', 'paper'], 'string', 'max' => 50],
            [['size'], 'string', 'max' => 30],
            [['unit', 'weight'], 'string', 'max' => 20],
            [['pages'], 'string', 'max' => 5],
            [['price'], 'double'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'            => Yii::t('app', 'pub_list_id'),
            'code'          => Yii::t('app', 'production_code'),
            'name'          => Yii::t('app', 'pub_name'),
            'type'          => Yii::t('app', 'pub_type'),
            'size'          => Yii::t('app', 'production_size'),
            'unit'          => Yii::t('app', 'pub_unit'),
            'paper'         => Yii::t('app', 'production_paper'),
            'weight'        => Yii::t('app', 'production_weight'),
            'pages'         => Yii::t('app', 'production_pages'),
            'status'        => Yii::t('app', 'pub_status'),
            'created_at'    => Yii::t('app', 'pub_created_at'),
            'updated_at'    => Yii::t('app', 'pub_updated_at'),
            'print_type'    => Yii::t('app', 'production_print_type'),
            'price'         => Yii::t('app', 'price'),
            'amount'        => Yii::t('app', 'production_amount'),
            'pcs'           => Yii::t('app', 'production_pcs'),
        ];
    }
}
