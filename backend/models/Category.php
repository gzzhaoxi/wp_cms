<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use common\helpers\FamilyTree;
use yii\helpers\ArrayHelper;
use common\libs\Constants;


class Category extends \yii\db\ActiveRecord
{

    public $spacer;
    public $childlist;
    public $haschild;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category}}';
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
            [['name'], 'required'],
            [['parent_id', 'created_at', 'updated_at', 'weigh'], 'integer'],
            [['flag'], 'string'],
            [['type', 'name', 'diyname', 'status'], 'string', 'max' => 30],
            [['nickname'], 'string', 'max' => 50],
            [['image'], 'string', 'max' => 100],
            [['keywords', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'            => Yii::t('app', 'pub_list_id'),
            'parent_id'     => Yii::t('app', 'label_category_pid'),
            'type'          => Yii::t('app', 'pub_type'),
            'name'          => Yii::t('app', 'pub_name'),
            'nickname'      => Yii::t('app', 'pub_nickname'),
            'flag'          => Yii::t('app', 'pub_flag'),
            'image'         => Yii::t('app', 'pub_image'),
            'keywords'      => Yii::t('app', 'pub_keywords'),
            'description'   => Yii::t('app', 'pub_description'),
            'diyname'       => Yii::t('app', 'label_category_diyname'),
            'created_at'    => Yii::t('app', 'pub_created_at'),
            'updated_at'    => Yii::t('app', 'pub_updated_at'),
            'weigh'         => Yii::t('app', 'pub_sort'),
            'status'        => Yii::t('app', 'pub_status'),
        ];
    }

    public static function getList($type = null){
        $query_cond = ['status' => Constants::STATUS_NORMAL];
        if($type){
            $query_cond = ArrayHelper::merge(['type' => $type], $query_cond);
        }
        //['type' => $type, 'status' => Constants::STATUS_NORMAL]
        return self::find()->where($query_cond)->orderBy('weigh asc, parent_id asc')->asArray()->all();
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    protected static function _getCategories($type = null)
    {
        //return self::find()->orderBy("sort asc,parent_id asc")->asArray()->all();
        return self::find()->where(['type' => $type, 'status' => Constants::STATUS_NORMAL])->orderBy('weigh asc, parent_id asc')->asArray()->all();
    }

    /**
     * @return array
     */
    public static function getCategories($type = null)
    {
        $categories = self::_getCategories($type);
        $familyTree = new FamilyTree($categories);
        $array = $familyTree->getDescendants(0, $type);
        return ArrayHelper::index($array, 'id');
    }

    /**
     * @return array
     */
    public static function getCategoriesName($type)
    {
        $categories = self::getCategories($type);
        $data = [];
        foreach ($categories as $v){
            $data[$v['id']] = str_repeat('--', $v['level']) . $v['name'];
        }
        return $data;
    }

    /**
     * @param $id
     * @return array
     */
    public static function getDescendants($id, $type)
    {
        $familyTree = new FamilyTree(self::_getCategories($type));
        return $familyTree->getDescendants($id);
    }

    //
    public static function getCateName($parent_id = null){
        if($parent_id){
            $data = self::findOne(['id' => $parent_id]);
            return $data->name;
        }
    }

}
