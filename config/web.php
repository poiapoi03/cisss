<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$db_cisurdb = require __DIR__ . '/db_cisurdb.php';
$db_admindb = require __DIR__ . '/db_admindb.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'timeZone' => 'Asia/Manila', 
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => [
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ], 
        'admin' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'right-menu', // set menu
            'mainLayout' => '@app/views/layouts/main.php',//set to apply AdminLte Theme
            'controllerMap' => [
                'assignment' => [
                   'class' => 'mdm\admin\controllers\AssignmentController',
                   /* 'userClassName' => 'app\models\User', */
                   'idField' => 'user_id',
                   
                   'searchClass' => 'mdm\admin\models\searchs\User' //update this to 'mdm\admin\models\searchs\User'
               ],
           ],
        ],
        'user' => [
            'class' => Da\User\Module::class,
            'administrators'=>['admin'],
            'enableEmailConfirmation'=>true,
            // ...other configs from here: [Configuration Options](installation/configuration-options.md), e.g.
            // 'generatePasswords' => true,
            // 'switchIdentitySessionKey' => 'myown_usuario_admin_user_key',
        ]
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/index',
           # 'admin/*',
            'user/*',
            'debug/*',
           'profile/*',
           'site/*'
            //'some-controller/some-action',
            // The actions listed here will be allowed to everyone including guests.
            // So, 'admin/*' should not appear here in the production, of course.
            // But in the earlier stages of your development, you may probably want to
            // add a lot of actions here until you finally completed setting up rbac,
            // otherwise you may not even take a first step.
        ]
    ],
    'components' => [
        'defaultTimeZone' => date_default_timezone_get(),
        'assetManager' => [
            'bundles' => [
                'yidas\yii2\adminlte\plugins\iCheckAsset' => [
                    'skin' => 'flat/aero',
                ],
            ],
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                   '@app/views' => '@app/views/layouts/simple'
                ],
            ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'OPRkSxrK4jC5YcyGeF4tiZ5cyEtpo3ei',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        // 'user' => [
        //     'identityClass' => 'app\models\User',
        //     'enableAutoLogin' => true,
        // ],
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
        // 'mailer' => [
        //     'class' => 'yii\swiftmailer\Mailer',
        //     'transport' => [
        //         'class' => 'Swift_SmtpTransport',
        //         'host' => 'smtp.gmail.com',  // e.g. smtp.mandrillapp.com or smtp.gmail.com
        //         'username' => 'ncs.sec.local@gmail.com',
        //         'password' => 'qsef123qsef',
        //         'port' => '587', // Port 25 is a very common port too
        //         'encryption' => 'tls', // It is often used, check your provider or mail server specs
        //         'streamOptions' => [
        //             'ssl' => [
        //                 'allow_self_signed' => true,
        //                 'verify_peer' => false,
        //                 'verify_peer_name' => false,
        //             ],
        //         ],
        //     ],
        // ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\DbManager'
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
        'db_cisurdb'=> $db_cisurdb,
        'db_admindb'=> $db_admindb,
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
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
