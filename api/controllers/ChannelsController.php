<?php
/**
 * Created by PhpStorm.
 * User: Narek
 * Date: 3/31/2016
 * Time: 11:25
 */

namespace api\controllers;

use common\models\Country;
use common\models\Tv;
use Yii;
use yii\filters\ContentNegotiator;
use yii\filters\VerbFilter;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class ChannelsController extends Controller
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
     * @param $alias
     * @return array|\yii\db\ActiveRecord[]
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionCountryChannels($alias){

        $country = Country::findOne(['alias' => $alias]);

        if (empty($country)) {
            throw new NotFoundHttpException();
        }
        $channel = Tv::find()
            ->select(['tvs.id', 'tvs.alias', 'languages_has_tvs.title', 'languages_has_tvs.description', 'tvs.url', 'tvs.path', 'tvs.rating', 'tvs.country_id'])
            ->leftJoin('languages_has_tvs', 'languages_has_tvs.tv_id = tvs.id')
            ->leftJoin('languages', 'languages_has_tvs.lang_id = languages.id')
            ->where(['tvs.country_id' => $country->id, 'tvs.status' => 1])
            ->andWhere(['languages.iso' => Yii::$app->language])
            ->asArray()
            ->all();

        return $channel;
    }

    /**
     * @param $alias
     * @param $alias2
     * @return array|null|\yii\db\ActiveRecord
     * @throws NotFoundHttpException
     */
    public function actionCountryChannel($alias, $alias2){

        $country = Country::findOne(['alias' => $alias]);
        $channel = Tv::find()
            ->select(['tvs.id', 'tvs.alias', 'languages_has_tvs.title', 'languages_has_tvs.description', 'tvs.url', 'tvs.path', 'tvs.rating', 'tvs.country_id'])
            ->where(['tvs.country_id' => $country->id, 'tvs.alias' => $alias2, 'tvs.status' => 1])
            ->leftJoin('languages_has_tvs', 'languages_has_tvs.tv_id = tvs.id')
            ->leftJoin('languages', 'languages_has_tvs.lang_id = languages.id')
            ->andWhere(['languages.iso' => Yii::$app->language])
            ->asArray()
            ->one();
        if (empty($country || $channel)) {
            throw new NotFoundHttpException();
        }

        return $channel;
    }
}