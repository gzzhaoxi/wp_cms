<?php
/**
 * Created by PhpStorm.
 * User: gzzhaoxi@gmail.com
 * Date: 2017/7/5
 * Time: 16:12
 */
namespace backend\widgets;

use Yii;
use yii\base\Widget;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class Breadcrumbs extends \yii\widgets\Breadcrumbs
{
    public $options = ['class' => 'breadcrumb pull-left'];

    public $tag = 'ol';

    public $homeLinkTemplate = '<li><i class="fa fa-dashboard"> {link} </i></li>';


    //
    public function run()
    {
        $this->homeLink = [
            'label' => Yii::t('app', 'layout_content_nav_dashboard'),
            'url' => Yii::$app->homeUrl,//'http://admin.cms.cc',
        ];

        if (empty($this->links)) {
            return;
        }
        $links = [];
        if ($this->homeLink === null) {
            $links[] = $this->renderItem([
                'label' => Yii::t('yii', 'Home'),
                'url' => Yii::$app->homeUrl,
            ], $this->itemTemplate);
        } elseif ($this->homeLink !== false) {
            $links[] = $this->renderItem($this->homeLink, $this->homeLinkTemplate);
        }
        foreach ($this->links as $link) {
            if (!is_array($link)) {
                $link = ['label' => $link];
            }
            $links[] = $this->renderItem($link, isset($link['url']) ? $this->itemTemplate : $this->activeItemTemplate);
        }
        echo Html::tag($this->tag, implode('', $links), $this->options);
    }

}