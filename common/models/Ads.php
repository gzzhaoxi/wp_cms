<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%ads}}".
 *
 * @property integer $id
 * @property string $title
 * @property integer $type
 * @property integer $position
 * @property string $text
 * @property string $photo
 * @property string $link
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Ads extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ads}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'position', 'status', 'created_at', 'updated_at'], 'integer'],
            [['text', 'photo'], 'string'],
            [['title'], 'string', 'max' => 200],
            [['link'], 'string', 'max' => 255],
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
            'type' => Yii::t('app', 'pub_type'),
            'position' => Yii::t('app', 'pub_position'),
            'text' => Yii::t('app', 'pub_text'),
            'photo' => Yii::t('app', 'pub_photo'),
            'link' => Yii::t('app', 'pub_link'),
            'status' => Yii::t('app', 'pub_status'),
            'created_at' => Yii::t('app', 'pub_created_at'),
            'updated_at' => Yii::t('app', 'pub_updated_at'),
        ];
    }
}
