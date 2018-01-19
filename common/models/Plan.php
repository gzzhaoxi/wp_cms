<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%plan}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $subhead
 * @property string $price
 * @property string $link
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Plan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%plan}}';
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
            [['price'], 'number'],
            [['status'], 'required'],
            [['status','sort', 'created_at', 'updated_at'], 'integer'],
            [['detail'], 'string'],
            [['title'], 'string', 'max' => 50],
            [['subhead', 'link'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'pub_title'),
            'subhead' => Yii::t('article', 'pub_subhead'),
            'price' => Yii::t('app', 'pub_price'),
            'sort' => Yii::t('app', 'pub_sort'),
            'link' => Yii::t('app', 'pub_link'),
            'status' => Yii::t('app', 'pub_status'),
            'created_at' => Yii::t('app', 'pub_created_at'),
            'updated_at' => Yii::t('app', 'pub_updated_at'),
        ];
    }
}
