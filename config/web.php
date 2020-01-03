<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

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
            'transport'        => [
                'class'      => 'Swift_SmtpTransport',
                'host'       => 'smtp.beget.com',//'smtp.yandex.ru',
                'username'   => 'info@schaste-club.ru',
                'password'   => 'Ctht;tymrf1',
                'port'       => '465',
                'encryption' => 'ssl',
            ],
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
                'journal' => 'journal/index',
                'group' => 'group/index',
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
        ],
    ],
    'params' => $params,
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
