<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%region}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $parent_id
 * @property integer $level
 */
class Region extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        //return '{{%region}}';
        return '{{%areas}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name', 'parent_id', 'level'], 'required'],
            [['id', 'parent_id', 'level'], 'integer'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'        => Yii::t('app', 'ID'),
            'name'      => Yii::t('app', 'Name'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'level'     => Yii::t('app', 'Level'),
        ];
    }

    //
    public static function getRegion($parentId=0)
    {
        $result = static::find()->where(['parent_id'=>$parentId])->asArray()->all();
        return ArrayHelper::map($result, 'id', 'name');
    }

    //
    public static function getRegionName($arr_region_id){
        $result = self::find()->where(['id' => $arr_region_id])->asArray()->all();
        $full_region_name = '';
        if($result){

            foreach($result as $item){
                $full_region_name .= $item['name'].' ';
            }
        }
        //return '<u>'.$full_region_name.'</u>';
        return $full_region_name;
    }
}