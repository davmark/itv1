<?php

namespace api\controllers;

use common\models\User;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\QueryParamAuth;
use yii\filters\ContentNegotiator;
use yii\rest\ActiveController;
use yii\web\Response;

class CountryController extends ActiveController
{
    public $modelClass = 'common\models\Country';

    public function behaviors()
    {
//        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'authMethods' => [
                [
                    'class' => HttpBasicAuth::className(),
                    'auth' => function ($username, $password) {
                        $out = null;
                        $user = User::findByUsername($username);
                        if ($user != null) {
                            if ($user->validatePassword($password)) $out = $user;
                        }
                        return $out;
                    }
                ],
                [
                    'class' => QueryParamAuth::className(),
                ]
            ]
        ];
        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
                //'application/xml' => Response::FORMAT_XML,
            ],
        ];

        return $behaviors;
    }
}