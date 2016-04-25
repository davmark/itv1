<?php
/**
 * Created by PhpStorm.
 * User: Narek
 * Date: 3/31/2016
 * Time: 11:25
 */

namespace api\controllers;

use common\models\Category;
use common\models\Country;
use common\models\Program;
use common\models\Show;
use common\models\Tv;
use Yii;
use yii\filters\ContentNegotiator;
use yii\filters\VerbFilter;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class CategoriesController extends Controller
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
    public function actionCategory($alias){


        $categories = Category::findOne(['alias' => $alias]);

        if (empty($categories)) {
            throw new NotFoundHttpException();
        }

        $shows = Show::find()
            ->select(['shows.id','shows.alias', 'languages_has_shows.title', 'languages_has_shows.description', 'shows.path'])
            ->leftJoin('languages_has_shows', 'languages_has_shows.show_id = shows.id')
            ->leftJoin('languages', 'languages_has_shows.lang_id = languages.id')
            ->leftJoin('categories_shows', 'categories_shows.show_id = shows.id')
            ->where(['languages.iso' => Yii::$app->language])
            ->andWhere(['categories_shows.category_id' => $categories->id])
            ->asArray()->all();


        return $shows;
    }

    /**
     * @param $alias
     * @param $alias2
     * @return array|null|\yii\db\ActiveRecord
     * @throws NotFoundHttpException
     */
    public function actionPrograms($alias){

        $shows = Show::findOne(['alias' => $alias]);

        if (empty($shows)) {
            throw new NotFoundHttpException();
        }

        $programs = Program::find()->orderBy(['publishedAt' => SORT_DESC])
            ->where(['shows_id' => $shows->id])
            ->asArray()->all();

        return $programs;
    }
}