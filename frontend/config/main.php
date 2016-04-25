<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);
if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'defaultRoute' => 'site',
    'modules' => [
        'api' => [
            'class' => 'app\modules\api\Module',
        ],
    ],

    'components' => [
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            //'suffix' => '.html',
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'user'],
                '<language:(ru|en)>' => 'site/index',
                '<language:(ru|en)>/tvs/<alias:[a-zA-Z0-9_-]+>' => 'tvs/tvs',
                'tvs/<alias:[a-zA-Z0-9_-]+>' => 'tvs/tvs',
                '<language:(ru|en)>/search' => 'search',
                '<language:(ru|en)>/search/<search_text:\w+>' => 'search',
                'search/<search_text:\w+>' => 'search',
                '<language:(ru|en)>/tv/<alias:[a-zA-Z0-9_-]+>' => 'tvs/tv',
                'tv/<alias:[a-zA-Z0-9_-]+>' => 'tvs/tv',
                '<language:(ru|en)>/program/<alias>/<alias2>'=>'tvs/program',
                'program/<alias>/<alias2>'=>'tvs/program',
                '<language:(ru|en)>/category/<alias>'=>'categories/category',
                'category/<alias>'=>'categories/category',
                '<language:(ru|en)>/<action:(contact|login|logout)>' => 'site/<action>',
                '<language:(ru|en)>/<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<language:(ru|en)>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<language:(ru|en)>/<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            ],
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'authUrl' => 'https://www.facebook.com/dialog/oauth?display=popup',
                    'clientId' => '1688081258133987',
                    'clientSecret' => 'bbb8fff9522fa50331c216b03c2544ba',
                ],
                'vkontakte' => [
                    'class' => 'yii\authclient\clients\VKontakte',
                    'clientId' => '5288763',
                    'clientSecret' => 'NMgPqyIdiIUbSUV1mbJa',
                ],
                'google' => [
                    'class' => 'yii\authclient\clients\GoogleOpenId'
                ],

//                'google' => [
//                    'class' => 'yii\authclient\clients\GoogleOAuth',
//                    'clientId' => '95892474818-r3fv1usbc9er4uq8dmqhs52nl1k0lpfc.apps.googleusercontent.com',
//                    'clientSecret' => 'zsXVirFIoyMvSowzhOdN-Q1e',
//                ],
//                'twitter' => [
//                    'class' => 'yii\authclient\clients\Twitter',
//                    'consumerKey' => 'twitter_consumer_key',
//                    'consumerSecret' => 'twitter_consumer_secret',
//                ],
//                'github' => [
//                    'class' => 'yii\authclient\clients\GitHub',
//                    'clientId' => 'github_client_id',
//                    'clientSecret' => 'github_client_secret',
//                ],
//                'linkedin' => [
//                    'class' => 'yii\authclient\clients\LinkedIn',
//                    'clientId' => 'linkedin_client_id',
//                    'clientSecret' => 'linkedin_client_secret',
//                ],
//                'live' => [
//                    'class' => 'yii\authclient\clients\Live',
//                    'clientId' => 'live_client_id',
//                    'clientSecret' => 'live_client_secret',
//                ],
//                'yandex' => [
//                    'class' => 'yii\authclient\clients\YandexOAuth',
//                    'clientId' => 'yandex_client_id',
//                    'clientSecret' => 'yandex_client_secret',
//                ],
            ],
        ],

        'assetManager' => [
            'basePath' => '@webroot/assets',
            'baseUrl' => '@web/assets'
        ],

        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];
