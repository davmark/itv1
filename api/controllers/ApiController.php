<?php
namespace api\controllers;
use common\models\User;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;
class ApiController extends ActiveController
{
    public $modelClass = 'common\models\Country';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::className(),
            'auth' => function ($username, $password) {
                $model = User::findOne(['username' => $username]);
                if ($model->validatePassword($password)) {
                    return $model;
                }
            }
//            'auth' => [$this, 'httpBasicAuthHandler'],

        ];
        return $behaviors;
    }
    public function httpBasicAuthHandler($username, $password)
    {
        // For example search by username and password
        $model = User::findOne(['username' => $username]);
        if ($model->validatePassword($password)) {
            return $model;
        }
    }


}
