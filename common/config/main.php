<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        // 'urlManager'=>[
        //     'enablePrettyUrl'=>true,
        //     'showScriptName'=>false,
        //     'rules'=>[
        //         ''=>'site/index',
        //         '<action>'=>'site/<action>'
        //         [
        //             'pattern'=>'id',
        //             'route'=>'post/show',
        //             'suffix'=>'.html'
        //         ]
        //     ]
        // ]
    ],
];
