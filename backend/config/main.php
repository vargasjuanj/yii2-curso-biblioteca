<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php',
);

return [
    'id' => 'app-backend',
    'name' => 'Biblioteca - Administración',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
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
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
            ],
        ],
        'view'=>[
            'theme'=>[
                'pathMap'=>[
                    '@app/views'=>'@app/themes/adminlte'
                ],
            ],
        ],
        
    ],
    'params' => $params,
];