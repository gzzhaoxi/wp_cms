<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%project_msg}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $tel
 * @property string $email
 * @property string $msg
 * @property integer $project_id
 * @property integer $created_at
 * @property integer $updated_at
 */
class ProjectMsg extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%project_msg}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['msg'], 'string'],
            [['project_id'], 'required'],
            [['project_id', 'created_at', 'updated_at','user_id'], 'integer'],
            [['name', 'tel', 'email'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'tel' => Yii::t('app', 'Tel'),
            'email' => Yii::t('app', 'Email'),
            'msg' => Yii::t('app', 'Msg'),
            'project_id' => Yii::t('app', 'Project ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }
    
    public static function getUserProjectMsgSum(){
        return self::find()->where(['user_id'=>Yii::$app->getUser()->id])
        ->count();
    }
}
