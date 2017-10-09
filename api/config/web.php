<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'tmqLtj1A_kh0ySVsddQxThuGUmSldpo8',
//            'cookieValidationKey' => \DockerEnv::get('COOKIE_VALIDATION_KEY', null, !YII_ENV_TEST),
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        /*'response' => [
            'format' => yii\web\Response::FORMAT_JSON,
            'charset' => 'UTF-8',
        ],*/
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
            'useFileTransport' => true,
        ],
        'log' => [
//            'traceLevel' => YII_DEBUG ? 3 : 0,
            'traceLevel' => \DockerEnv::get('YII_TRACELEVEL', 0),
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,


        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => [
                        'departments' => "department"
                    ],
                    'patterns' => [
                        'GET' => 'index',
                        'OPTIONS' => 'options',
                        'GET byid' => 'byid',
                        'OPTIONS byid' => 'options'
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => [
                        'products' => "product"
                    ],
                    'patterns' => [
                        'GET' => 'index',
                        'GET <id>' => 'view',
                        'PUT,PATCH <id>' => 'update',
                        'DELETE <id>' => 'delete',
                        'POST' =>'create',
                        'OPTIONS' => 'options',
                        'GET random-images' => 'get-random-images',
                        'GET by-department' => 'by-department',
                        'OPTIONS by-department' => 'options',
                        'OPTIONS filtered/by-department-sumary' => 'options',
                        'OPTIONS <id>' => 'options',
                        'GET filtered/by-department-sumary' => 'with-image',
                        'OPTIONS random-images' => 'options'
                    ]
                ],
                [
                    'pattern' => 'populate-departments',
                    'route' => 'default/populate-departments'
                ],
                [
                    'pattern' => 'populate-products',
                    'route' => 'default/populate-products'
                ],
                [
                    'pattern' => 'random-images',
                    'route' => 'default/get-random-images'
                ],
                [
                    'pattern' => 'populate-images',
                    'route' => 'default/populate-images'
                ],
            ],
        ]
    ]
];

//if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '172.*.*.*', '::1', '192.168.0.*', '192.168.*.*', 'XXX.XXX.XXX.XXX']
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
//        'allowedIPs' => ['127.0.0.1', '::1'],
        'allowedIPs' => ['127.0.0.1', '172.*.*.*', '::1', '192.168.0.*', '192.168.*.*', 'XXX.XXX.XXX.XXX']
    ];
//}

return $config;
