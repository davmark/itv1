<?php
/**
 * Created by PhpStorm.
 * User: Artur
 * Date: 1/27/2016
 * Time: 2:28 PM
 */

namespace frontend\controllers;
use common\models\Category;
use common\models\Show;


/**
 * categories controller
 */

class CategoriesController extends BaseController
{

    /**
     * @return string
     */
    function actionIndex()
    {
        $categories = Category::find()->all();

        return $this->render('index', [
            'categories' => $categories
        ]);
    }

    /**
     * @param $alias
     * @return string
     * @throws \yii\web\NotFoundHttpException
     */
    function actionCategory($alias)
    {
        $category = Category::findOne(['alias' => $alias]);

        $shows = show::find()
            ->where(['shows.status' => 1])
            ->joinWith('categoriesShows', 'programs')
            ->where(['categories_shows.category_id' => $category->id])
            ->joinWith('programs')
            ->orderBy(['programs.publishedAt' => SORT_DESC])
            ->all();

        if(empty($category)){
            throw new \yii\web\NotFoundHttpException();
        }

        return $this->render('category', [
            'shows'   => $shows,
            'category' => $category,
        ]);
    }
}