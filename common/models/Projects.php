<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%projects}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $office_name
 * @property string $address
 * @property string $link
 * @property string $msg
 * @property string $photo
 * @property integer $status
 * @property integer $must_input
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $hit
 * @property integer $user_id
 */
class Projects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%projects}}';
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
            [['name', 'office_name', 'link', 'user_id'], 'required'],
            [['address', 'msg'], 'string'],
            [['status', 'must_input', 'created_at', 'updated_at', 'hit', 'user_id'], 'integer'],
            [['name', 'office_name', 'link', 'photo'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Agent Name'),
            'office_name' => Yii::t('app', 'Office Name'),
            'address' => Yii::t('app', 'Property Address'),
            'link' => Yii::t('app', 'Virtual Reality Showcase Link'),
            'msg' => Yii::t('app', 'Intro Msg'),
            'photo' => Yii::t('app', 'Intro Image'),
            'status' => Yii::t('app', 'Status'),
            'must_input' => Yii::t('app', 'Visitor Registration Options'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'hit' => Yii::t('app', 'Visit'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }
    public static function getUserProjectCount()
    {
        return self::find()->where(['user_id'=>Yii::$app->getUser()->id])
        ->count();
    }
    
    public static function getUserProjectHitSum()
    {
        $res = self::find()->where(['user_id'=>Yii::$app->getUser()->id])->sum('hit');
        return $res ? $res : 0;
    }
    
    public function addProject($param) {
        $this->load($param,'');
        $result = $this->save();
        return $result ? $this->id : false;
    }
}
