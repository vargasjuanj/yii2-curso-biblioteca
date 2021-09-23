<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php',
);

return [
    'id' => 'api',
    'name' => 'Biblioteca - Administración',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'dynagrid' => [
            'class' => '\kartik\dynagrid\Module'
            //other settings (refer documentation)
        ],
        'gridView' => [
            'class' => '\kartik\grid\Module'
        ],
        'helpers' => [
            'class' => '\kartik\helpers\Module'
        ],
        'detailView' => [
            'class' => '\kartik\detailView\Module'
        ],
    ],
    'components' => [
        'request' => [

            'parsers' => [
        
                'application/json' => 'yii\web\JsonParser',
        
            ]
        
            ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-api', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the api
            'name' => 'advanced-api',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
               
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info', 'trace','error','warning'],
                    'categories' => ['sesiones'],
                    'logVars' => [],
                    'logFile' => '@runtime/logs/control/sesiones.log',
                ],
             
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info', 'trace','error','warning'],
                    'categories' => ['libros'],
                    'logVars' => [],
                    'logFile' => '@runtime/logs/control/libros.log',
                ],
                [

                    'class' => 'yii\log\FileTarget',
                
                    'levels' => ['error', 'warning'],
                
                    'categories' => [
                
                        'yii\db\*',
                
                        'yii\web\HttpException:*',
                
                    ],
                
                    'except' => [
                
                        'yii\web\HttpException:404',
                
                    ],
                
                ]
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
            'maxSourceLines' => 20
        ],
        
        'urlManager' => [

            'enablePrettyUrl' => true,
       
            'enableStrictParsing' => true,
       
            'showScriptName' => false,
       
            'rules' => [
       
                 ['class' => 'yii\rest\UrlRule', 'controller' => 'socio'],
       
                 ['class' => 'yii\rest\UrlRule', 'controller' => 'libro'],

                 ['class' => 'yii\rest\UrlRule', 'controller' => 'prestamo'],
       
             ],
       
       ]  ,
        'view'=>[
            'theme'=>[
                'pathMap'=>[
                    '@api/views'=>'@api/themes/adminlte'
                ],
            ],
        ],
        
    ],
    'params' => $params,
];