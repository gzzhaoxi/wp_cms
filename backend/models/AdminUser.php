<?php

namespace backend\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use \yii\web\ForbiddenHttpException;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

class AdminUser extends ActiveRecord implements IdentityInterface
{
    /**
     * @数据模型定义
     */
    const STATUS_ACTIVE = 1;
    const STATUS_CLOSED = 0;

    public $password;
    public $repassword;
    public $oldpassword;

    /**
     * @数据库表名
     */
    public static function tableName()
    {
        return '{{%admin_user}}';
    }

    /**
     * @数据模型规则定义
     */
    public function rules()
    {
        return [
            [['username', 'password', 'repassword', 'password_hash'], 'string'],
            ['email', 'email'],
            ['email', 'unique'],
            [['repassword'], 'compare', 'compareAttribute' => 'password'],
            [['avatar'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif, webp'],
            [['status'], 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_CLOSED]],
            [['username', 'email', 'password', 'repassword'], 'required', 'on' => ['create']],
            [['username', 'email'], 'required', 'on' => ['update', 'self-update']],
            [['username'], 'unique', 'on' => 'create'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            'default' => ['username', 'email'],
            'create' => ['username', 'email', 'password', 'avatar', 'status'],
            'update' => ['username', 'email', 'password', 'avatar', 'status'],
            'self-update' => ['username', 'email', 'password', 'avatar', 'oldpassword', 'repassword'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username'      => yii::t('app', 'pub_account'),
            'email'         => yii::t('app', 'pub_email'),
            'oldpassword'  => yii::t('app', 'pub_oldpassword'),
            'password'      => yii::t('app', 'pub_password'),
            'repassword'    => yii::t('app', 'pub_repassword'),
            'avatar'        => yii::t('app', 'pub_avatar'),
            'status'        => yii::t('app', 'pub_status'),
            'created_at'    => yii::t('app', 'pub_created_at'),
            'updated_at'    => yii::t('app', 'pub_updated_at')
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    //
    public static function getStatuses()
    {
        return [
            self::STATUS_ACTIVE => yii::t('app', 'pub_status_normal'),
            self::STATUS_CLOSED => yii::t('app', 'pub_status_disabled'),
        ];
    }

    //
    public static function showStatus($status = ''){
        if($status !== null){
            return ($status === self::STATUS_ACTIVE) ? yii::t('app', 'pub_status_normal') : yii::t('app', 'pub_status_disabled');
        }
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (! static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int)substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        /* 用户头像管理
        $upload = UploadedFile::getInstance($this, 'avatar');
        if ($upload !== null) {
            $uploadPath = yii::getAlias('@admin/uploads/avatar/');
            if (! FileHelper::createDirectory($uploadPath)) {
                $this->addError('thumb', "Create directory failed " . $uploadPath);
                return false;
            }
            $fullName = $uploadPath . uniqid() . '.' . $upload->extension;
            if (! $upload->saveAs($fullName)) {
                $this->addError('avatar', yii::t('app', 'Upload {attribute} error: ' . $upload->error, ['attribute' => yii::t('app', 'Avatar')]) . ': ' . $fullName);
                return false;
            }
            $avatar = $this->getOldAttribute('avatar');
            if(!empty($avatar)) {
                $file = yii::getAlias('@frontend/web') . $this->getOldAttribute('avatar');
                if(file_exists($file)) unlink($file);
            }
            $this->avatar = str_replace(yii::getAlias('@frontend/web'), '', $fullName);
        } else {
            $this->avatar = $this->getOldAttribute('avatar');
        }
        */
        if ($insert) {
            $this->generateAuthKey();
            $this->setPassword($this->password);
        } else {
            if (isset($this->password) && $this->password != '') {
                $this->setPassword($this->password);
            }
        }
        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public function selfUpdate()
    {
        if ($this->password != '') {
            if ($this->oldpassword == '') {
                $this->addError('oldpassword', yii::t('yii', '{attribute} cannot be blank.', ['attribute' => yii::t('app', 'Old Password')]));
                return false;
            }
            if (! $this->validatePassword($this->oldpassword)) {
                $this->addError('oldpassword', yii::t('app', '{attribute} is incorrect.', ['attribute' => yii::t('app', 'Old Password')]));
                return false;
            }
            if ($this->repassword != $this->password) {
                $this->addError('repassword', yii::t('app', '{attribute} is incorrect.', ['attribute' => yii::t('app', 'Repeat Password')]));
                return false;
            }
        }
        return $this->save();
    }

    /**
     * @inheritdoc
     */
    public function beforeDelete()
    {
        if ($this->id == 1) {
            throw new ForbiddenHttpException(yii::t('app', "Not allowed to delete {attribute}", ['attribute' => yii::t('app', 'default super administrator admin')]));
        }
        return true;
    }


    /**
     * 关联admin_role_user表查询
     */
    public function getAdminRoleUser(){

        return $this->hasOne(AdminRoleUser::classname(), ['uid' => 'id']);

    }

    //
    public static function getSalesGroup(){

        $query = AdminUser::find();
        $query->select([AdminUser::tableName().'.username', AdminUser::tableName().'.id']);
        $query->joinWith(['adminRoleUser']);//调用AdminRoleUser下关联方法
        $query->where([AdminRoleUser::tableName().'.role_id' => AdminRoles::getSalesGroupId()]);

        //echo $query->createCommand()->getRawSql();
        //exit();
        $list = $query->asArray()->all();
        if(isset($list)){
            $data = [];
            foreach($list as $item){
                $data[$item['id']] = $item['username'];
            }
            return $data;
        }
    }

    //
    public static function getUserNameById($id){
        if($id){
            $data = self::findOne(['id' => $id]);
            return isset($data->username) ? $data->username : null;
        }
    }

}
