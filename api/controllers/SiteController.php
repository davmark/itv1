<?php
/**
 * Created by PhpStorm.
 * User: Artur
 * Date: 2/24/2016
 * Time: 13:12
 */
namespace api\controllers;

use common\models\Category;
use common\models\Country;

use Yii;
use yii\filters\ContentNegotiator;
use yii\filters\VerbFilter;
use yii\rest\Controller;
use yii\web\Response;


class SiteController extends Controller
{

    public function behaviors()
    {
        return [
            'contentNegotiator' => [
                'class' => ContentNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                    //'application/xml' => Response::FORMAT_XML,
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['GET', 'HEAD'],
                    'view' => ['GET', 'HEAD'],
                    'create' => ['POST'],
                    'update' => ['PUT', 'PATCH'],
                    'delete' => ['DELETE'],
                ],
            ],
        ];
    }

    public function init() {

        Yii::$app->language = Yii::$app->request->get('language') ? Yii::$app->request->get('language') : 'am';
        parent::init();
    }

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $customers = Country::find()
            ->select(['countries.id','countries.alias', 'languages_has_countries.title'])
            ->leftJoin('languages_has_countries', 'languages_has_countries.country_id = countries.id')
            ->leftJoin('languages', 'languages_has_countries.lang_id = languages.id')
            ->where(['languages.iso' => Yii::$app->language])
            ->with(['tvs' => function ($q) {
                $q->select(['tvs.id', 'tvs.alias', 'languages_has_tvs.title', 'languages_has_tvs.description', 'tvs.url', 'tvs.path', 'tvs.rating', 'tvs.country_id'])
                    ->leftJoin('languages_has_tvs', 'languages_has_tvs.tv_id = tvs.id')
                    ->leftJoin('languages', 'languages_has_tvs.lang_id = languages.id')
                    ->where(['tvs.status' => 1])
                    ->andWhere(['languages.iso' => Yii::$app->language]);
            }])
            ->asArray()->all();

        $categories = Category::find()
            ->select(['categories.id','categories.alias', 'languages_has_categories.title', 'languages_has_categories.description', 'categories.path', 'categories.icon'])
            ->leftJoin('languages_has_categories', 'languages_has_categories.category_id = categories.id')
            ->leftJoin('languages', 'languages_has_categories.lang_id = languages.id')
            ->where(['languages.iso' => Yii::$app->language])
            ->asArray()->all();

        $index = [
            'country_tvs' => $customers,
            'categories' => $categories,
        ];
        return $index;
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {

    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {

    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {

        return $this->render('about', [
        ]);
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {

    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {

    }
    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {

    }
    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws ActivateAccount
     */
    public function actionActivateAccount($token)
    {

    }
}
