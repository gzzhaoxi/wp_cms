<?php

namespace backend\models;

use common\libs\Constants;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

class Pdsetting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%pdsetting}}';
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
            [['type', 'status', 'created_at', 'updated_at', 'order'], 'integer'],
            [['type', 'name'], 'required'],
            [['name'], 'string', 'max' => 50],
            [['remark'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'          => yii::t('app', 'pub_list_id'),
            'name'        => yii::t('app', 'pub_name'),
            'type'        => yii::t('app', 'pub_type'),
            'status'      => yii::t('app', 'pub_status'),
            'remark'      => yii::t('app', 'pub_remark'),
            'created_at'  => yii::t('app', 'pub_created_at'),
            'updated_at'  => yii::t('app', 'pub_updated_at'),
            'order'       => yii::t('app', 'pub_sort'),
        ];
    }

    //
    public static function getProductionData($production_type){
        //
        $result = [];
        if($production_type){
            $result = self::find()->where(['type' => $production_type, 'status' => Constants::STATUS_NORMAL])
                ->orderBy(['order' => 'ASC'])
                ->asArray()->all();
            if(count($result) > 0) return ArrayHelper::map($result, 'id', 'name');
        }
    }
}
