<?php
/**
 * Created by PhpStorm.
 * User: Artur
 * Date: 2/22/2016
 * Time: 16:39
 */
namespace frontend\controllers;

use common\components\Helper;
use common\components\Search;
use common\models\Program;
use Yii;
use yii\helpers\Html;

class SearchController extends BaseController
{

    /**
     * @return string
     */
    public function actionIndex(){

        $page = Yii::$app->request->get('page');

        $search_text = Html::encode(str_ireplace('_', ' ', Yii::$app->request->get('search_text')));
        
        if(Yii::$app->request->post())
        {
            $search_text = strip_tags(Yii::$app->request->post('searchwords'));
            $search_text = urlencode($search_text);
            if (!empty($search_text))
            {
                $search_text = str_ireplace(' ', '_',  Html::encode($search_text));
                $search_uri = Html::encode($search_text);
                $this->redirect(Helper::lang('search?s='.$search_uri));
            }
        }
        $search_text = Yii::$app->request->get('s');
        $programs = Program::find()->asArray()->with('shows')->all();
        $search = new Search($search_text,$programs,
            array(
                'title' => 0.7,
                //'description' => 0.1,
            )
            ,0);

        return $this->render('index', [
            'title_search' => $search_text,
            'result_text' => $search->get_result_text(),
            'page'  =>  $page,
            'result'    =>  $search->get_result(),
        ]);
    }
}