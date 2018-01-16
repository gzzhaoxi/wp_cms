<?php
return [
    //'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'vendorPath' => dirname(dirname(__DIR__)) . '/../framework/vendor',
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            //'dsn' => 'mysql:host=172.26.21.180:9707;dbname=isms',
            'dsn' => 'mysql:host=localhost;dbname=cms',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'tablePrefix' => 'cms_',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'formatter' => [
            'dateFormat' => 'php:Y-m-d H:i',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
            'currencyCode' => 'CHY',
            'nullDisplay' => '-',
        ],
        'view' => [
            'class' => 'cmscore\components\View',
        ],
        //CMS INIT
        //'cmscore' => 'cmscore\components\Cmsinit',
    ],
];
