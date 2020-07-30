<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$mailer = require __DIR__.'/mailer.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'name' => 'Детский клуб «Счастье»',
    'language' => 'ru',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'iQdEBF-URK-HrF-MAd_RjDyNvRdvv4mw',
            'baseUrl' => '',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport'        => $mailer,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'profile' => 'profile/index',
                'profile/view/<id:\d+>' => 'profile/view',
                'profile/update/<id:\d+>' => 'profile/update-user',
                'order' => 'order/index',
                'order/view/<id:\d+>' => 'order/view',
                'order/update/<id:\d+>' => 'order/update',
                'customer' => 'customer/index',
                'customer/view/<id:\d+>' => 'customer/view',
                'customer/update/<id:\d+>' => 'customer/update',
                'program' => 'program/index',
                'program/view/<id:\d+>' => 'program/view',
                'program/update/<id:\d+>' => 'program/update',
                'payment' => 'payment/index',
                'payment/update-in/<id:\d+>' => 'payment/update-in',
                'payment/update-out/<id:\d+>' => 'payment/update-out',
                'journal' => 'journal/index',
                'group' => 'group/index',
                'message-from-site' => 'message-from-site/index',
                'dh' => 'dh/index',
                'group/view/<id:\d+>' => 'group/view',
                'group/update/<id:\d+>' => 'group/update',

                // rest api routing
                ['class' => 'yii\rest\UrlRule', 'controller' => 'user'],
                'api/delete-sticker/<id:\d+>' => 'api/delete-sticker',
                'api/update-sticker/<id:\d+>' => 'api/update-sticker',
                'api/delete-event/<id:\d+>' => 'api/delete-event',

            ],
        ],
        'i18n' => [
            'translations' => [
                'app' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'forceTranslation' => true,
                ],
            ],
        ],
        'formatter' => [
            'class' => '\app\components\FormatterHelper',
            'thousandSeparator' => ' ',
            // 'locale' => 'en-US',
            // 'dateFormat' => 'yyyy-MM-dd',
            // 'datetimeFormat' => 'yyyy-MM-dd HH:mm:ss',
            // 'decimalSeparator' => '.',
            // 'thousandSeparator' => ',',
            // 'currencyCode' => 'USD'
            'defaultTimeZone' => 'Asia/Yekaterinburg',
            'timeZone' => 'Asia/Yekaterinburg',
            'locale' => 'ru-Ru',
            'currencyCode' => 'RUB',
        ],
        'view' => [
            'class' => 'yii\web\View',
            'renderers' => [
                'twig' => [
                    'class' => 'yii\twig\ViewRenderer',
                    'cachePath' => '@runtime/Twig/cache',
                    // Array of twig options:
                    'options' => [
                        'auto_reload' => true,
                    ],
                    'globals' => [
                        'html' => ['class' => '\yii\helpers\Html'],
                        'array_helper' => ['class' => 'yii\helpers\ArrayHelper'],
                        'date_picker' => ['class' => 'yii\jui\DatePicker'],
                        'Url' => ['class' => 'yii\helpers\Url']
                    ],
                    'uses' => ['yii\bootstrap4'],
                    'functions' => array(
                        'lang' => 'Yii::t',
                    ),
                ],
            ],
        ]
    ],
    'params' => $params,
    'layout' => 'main.twig',
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
