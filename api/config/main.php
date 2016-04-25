<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php')
);
return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<language:(am|ru|en)>' => 'site/index',

                '<language:(am|ru|en)>/category/<alias:[a-zA-Z0-9_-]+>' => 'categories/category',
                'category/<alias:[a-zA-Z0-9_-]+>' => 'categories/category',
                'programs/<alias:[a-zA-Z0-9_-]+>' => 'categories/programs',

                '<language:(am|ru|en)>/<alias:[a-zA-Z0-9_-]+>' => 'channels/country-channels',
                '<language:(am|ru|en)>/<alias:[a-zA-Z0-9_-]+>/<alias2:[a-zA-Z0-9_-]+>' => 'channels/country-channel',

                '<alias:[a-zA-Z0-9_-]+>' => 'channels/country-channels',
                '<alias:[a-zA-Z0-9_-]+>/<alias2:[a-zA-Z0-9_-]+>' => 'channels/country-channel',

            ],
        ],
        'user' => [
            'identityClass' => '\common\models\User',
            'enableSession' => false,
            'loginUrl' => null
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
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'response' => [
            'format' => yii\web\Response::FORMAT_JSON,
            'charset' => 'UTF-8',
            'class' => '\api\components\ApiResponse',
        ],

    ],
    'params' => $params,
];