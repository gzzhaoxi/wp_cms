<?php
use backend\components\MenuHelper;
use backend\widgets\Menu;
use backend\models\Menu as MMenu;

?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">

                <img src="<?php
                if(yii::$app->getUser()->getIdentity()->avatar){
                    echo yii::$app->params['site']['url'] . yii::$app->getUser()->getIdentity()->avatar;
                }else{
                    echo yii::$app->params['admin']['url'] . 'static/images/avatar.png';
                }
                ?>" class="img-circle" alt="<?=yii::t('app', 'tips_user_avatar')?>"/>
            </div>
            <div class="pull-left info">
                <p><?=yii::$app->getUser()->getIdentity()->username?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> <?=yii::t('app', 'tips_user_online')?></a>
            </div>
        </div>

        <!-- search form
        <form action="#" method="get" class="sidebar-form">-->
            <div class="input-group" style="min-height: 20px">
                <!--
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
                -->
            </div>
        <!--</form>
         /.search form -->

        <?php
/*
        $callback = function($menu){
            $data = json_decode($menu['data'], true);
            $items = $menu['children'];
            $return = [
                'label' => $menu['name'],
                'url' => [$menu['route']],
            ];
            //处理我们的配置
            if ($data) {
                //visible
                isset($data['visible']) && $return['visible'] = $data['visible'];
                //icon
                isset($data['icon']) && $data['icon'] && $return['icon'] = $data['icon'];
                //other attribute e.g. class...
                $return['options'] = $data;
            }
            //没配置图标的显示默认图标
            //(!isset($return['icon']) || !$return['icon']) && $return['icon'] = 'circle-o';
            $items && $return['items'] = $items;
            return $return;
        };
*/
        /* */
        echo Menu::widget([
            'options' => ['class' => 'sidebar-menu'],
            //'items' => MenuHelper::getAssignedMenu(Yii::$app->user->id, null, $callback)
            'items' => MMenu::getBackendMenu()
        ]);

        //echo MMenu::getBackendMenu();
        ?>

    </section>

</aside>
