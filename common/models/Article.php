<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%article}}".
 *
 * @property string $id
 * @property integer $category_id
 * @property string $title
 * @property string $author
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $content
 * @property string $keywords
 * @property string $desc
 * @property integer $order
 * @property integer $is_top
 * @property integer $is_push
 * @property integer $is_delete
 * @property integer $read_count
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article}}';
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
            [['category_id','title','author'], 'required'],
            [['category_id', 'created_at', 'updated_at', 'order', 'is_top', 'is_push', 'is_delete', 'read_count'], 'integer'],
            [['content','desc'], 'string'],
            [['title', 'photo'], 'string', 'max' => 255],
            [['author'], 'string', 'max' => 20],
            [['keywords'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category_id' => Yii::t('article', 'category'),
            'title' => Yii::t('article', 'title'),
            'author' => Yii::t('article', 'author'),
            'photo' => Yii::t('article', 'photo'),
            'created_at' => Yii::t('app', 'pub_created_at'),
            'updated_at' => Yii::t('app', 'pub_updated_at'),
            'content' => Yii::t('article', 'content'),
            'keywords' => Yii::t('article', 'keywords'),
            'desc' => Yii::t('article', 'desc'),
            'order' => Yii::t('article', 'order'),
            'is_top' => Yii::t('article', 'is_top'),
            'is_push' => Yii::t('article', 'is_push'),
            'is_delete' => Yii::t('article', 'is_delete'),
            'read_count' => Yii::t('article', 'read_count'),
        ];
    }
}
