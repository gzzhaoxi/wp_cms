<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%plan_detail}}".
 *
 * @property integer $id
 * @property integer $plan_id
 * @property string $title
 * @property string $desc
 * @property integer $status
 * @property integer $updated_at
 * @property integer $created_at
 */
class PlanDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%plan_detail}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['plan_id'], 'required'],
            [['plan_id', 'status', 'updated_at', 'created_at'], 'integer'],
            [['title', 'desc'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'plan_id' => Yii::t('app', 'Plan ID'),
            'title' => Yii::t('app', 'Title'),
            'desc' => Yii::t('app', 'Desc'),
            'status' => Yii::t('app', 'Status'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}
