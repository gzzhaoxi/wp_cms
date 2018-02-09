<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%projects_visitor}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $phone
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $project_id
 */
class ProjectsVisitor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%projects_visitor}}';
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
            [['name', 'phone', 'project_id'], 'required'],
            [['created_at', 'updated_at', 'project_id'], 'integer'],
            [['name', 'phone'], 'string', 'max' => 255],
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
            'phone' => Yii::t('app', 'Phone'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'project_id' => Yii::t('app', 'Project ID'),
        ];
    }
    
    public function addVisitor($data){
        $this->load($data,'');
        $result = $this->save();
        return $result ? $this->id : false;
    }
}
