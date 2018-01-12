<?php
/**
 * @name MenuHlper.php
 * @author gzzhaoxi@gmail.com
 * @date 2017-11-14
 */

namespace backend\components;

use backend\models\AdminRoleUser;
use backend\models\AdminUser;
use Yii;
use backend\models\Menu;

class MenuHelper
{
    //
    public static function getBackendMenu(){
        //
        $role_id = AdminRoleUser::getRoleIdByUid();
        //$model


    }

//end of class
}
?>