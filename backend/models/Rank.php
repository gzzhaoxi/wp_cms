<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\base\InvalidParamException;
use common\libs\Constants;

/**
 * This is the model class for table "{{%rank}}".
 *
 * @property integer $id
 * @property integer $type
 * @property string $name
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Rank extends \yii\db\ActiveRecord
{
    const TYPE_RANK = 1;
    const TYPE_CASE = 2;

    //
    public static function getType($key = null)
    {
        //
        $arr_type = [
            self::TYPE_RANK => yii::t('app', 'customer_type_rank'),
            self::TYPE_CASE => yii::t('app', 'customer_type_case'),
        ];


        if ($key !== null) {
            if (key_exists($key, $arr_type)) {
                return $arr_type[$key];
            }
            throw new InvalidParamException( 'Unknown key:' . $key.'aa' );
        }
        return $arr_type;

    }

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
        return '{{%rank}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'status', 'created_at', 'updated_at', 'order'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['name'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'         => Yii::t('app', 'pub_list_id'),
            'type'       => Yii::t('app', 'pub_type'),
            'name'       => Yii::t('app', 'pub_name'),
            'status'     => Yii::t('app', 'pub_status'),
            'order'      => Yii::t('app', 'pub_sort'),
            'created_at' => Yii::t('app', 'pub_created_at'),
            'updated_at' => Yii::t('app', 'pub_updated_at'),
        ];
    }

    //按客户类型或等级,返回正常状态下信息
    public static function getTypeCase($type){
        if(!$type && !isset($type)) throw new InvalidParamException( 'Type is required:' . $type );
        $arr_result = self::find()->where(['status' => Constants::STATUS_NORMAL, 'type' => $type])->asArray()->all();
        if(isset($arr_result)){
            $arr_rank = [];
            foreach($arr_result as $item){
                $arr_rank[$item['id']] = $item['name'];
            }
            return $arr_rank;
        }else return false;
    }

    //返回rank表名称字段,不考虑状态
    public static function getTypeName($id){
        if(!$id || $id === null) throw new InvalidParamException( 'ID is required:' . $id );
        $data = self::findOne(['id' => $id]);
        return isset($data->name) ? $data->name : null;
    }

}
