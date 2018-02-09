<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2017-03-15 21:16
 */

namespace common\models;

use Yii;
use common\helpers\FamilyTree;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;

class Menu extends \yii\db\ActiveRecord
{
    const BACKEND_TYPE = 0;
    const FRONTEND_TYPE = 1;

    const DISPLAY_YES = 1;
    const DISPLAY_NO = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menu}}';
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
            [['parent_id'], 'integer'],
            [['sort'], 'number'],
            [['parent_id', 'sort'], 'default', 'value' => 0],
            [['sort'], 'compare', 'compareValue' => 0, 'operator' => '>='],
            [['is_display'], 'integer'],
            [['name', 'url', 'icon', 'method'], 'string', 'max' => 255],
            [['type', 'is_absolute_url'], 'in', 'range' => [0, 1]],
            [['target'], 'in', 'range' => ['_blank', '_self']],
            [['name'], 'required'],
            //[['method'], 'required', 'on' => ['backend']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            'backend' => [
                'parent_id',
                'name',
                'url',
                'icon',
                'type',
                'is_absolute_url',
                'target',
                'sort',
                'is_display',
                'method'
            ],
            'frontend' => [
                'parent_id',
                'name',
                'url',
                'icon',
                'type',
                'is_absolute_url',
                'target',
                'sort',
                'is_display'
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'                => Yii::t('app', 'pub_list_id'),
            'type'              => Yii::t('app', 'pub_type'),
            'parent_id'         => Yii::t('app', 'pub_parent_id'),
            'name'              => Yii::t('app', 'pub_name'),
            'url'               => Yii::t('app', 'pub_route'),
            'method'            => Yii::t('app', 'pub_http_method'),
            'icon'              => Yii::t('app', 'pub_image'),
            'sort'              => Yii::t('app', 'pub_sort'),
            'is_absolute_url'   => Yii::t('app', 'pub_is_abs').yii::t('app', 'pub_address'),
            'target'            => Yii::t('app', 'Target'),
            'is_display'        => Yii::t('app', 'pub_is_display'),
            'created_at'        => Yii::t('app', 'pub_created_at'),
            'updated_at'        => Yii::t('app', 'pub_updated_at'),
        ];
    }

    /**
     * @param $type
     * @return array|\yii\db\ActiveRecord[]
     */
    protected  static function _getMenus($type)
    {
        $menus = self::find()->where(['type' => $type])->orderBy("sort asc,parent_id asc")->asArray()->all();
        foreach ($menus as &$menu){
            $menu['name'] = yii::t('menu', $menu['name']);
        }
        return $menus;
    }

    /**
     * @param int $type
     * @return array
     */
    public static function getMenus($type=self::BACKEND_TYPE)
    {
        $menus = self::_getMenus($type);
        $familyTree = new FamilyTree($menus);
        $array = $familyTree->getDescendants(0);
        return ArrayHelper::index($array, 'id');
    }

    /**
     * @param int $type
     * @return array
     */
    public static function getMenusName($type=0)
    {
        $menus = self::getMenus($type);
        $data = [];
        foreach ($menus as $v){
            $data[$v['id']] = str_repeat('--', $v['level']) . $v['name'];
        }
        return $data;
    }

    /**
     * @inheritdoc
     */
    public function afterValidate()
    {
        if( !$this->getIsNewRecord() ){
            if($this->id == $this->parent_id) {
                $this->addError('parent_id', yii::t('app', 'Cannot be themself sub.'));
                return false;
            }
            $familyTree = new FamilyTree(Menu::_getMenus($this->type));
            $descendants = $familyTree->getDescendants($this->id);
            $descendants = array_column($descendants, 'id');
            if( in_array($this->parent_id, $descendants) ){
                $this->addError('parent_id', yii::t('app', 'Cannot be themselves descendants sub'));
                return false;
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function beforeDelete()
    {
        $menus = Menu::_getMenus($this->type);
        $familyTree = new FamilyTree( $menus );
        $subs = $familyTree->getDescendants($this->id);
        if (! empty($subs)) {
            $this->addError('id', yii::t('app', 'Sub Menu exists, cannot be deleted'));
            return false;
        }
        return true;
    }
}
