<?php
/**
 * Created by PhpStorm.
 * User: Narek
 * Date: 2/4/2016
 * Time: 11:09
 */

namespace common\components;

use common\models\Language;
use common\models\Program;
use common\models\Rate;
use common\models\Tv;
use frontend\models\Favorite;
use Yii;
use yii\helpers\Url;

class Helper
{

    public static function myHistorySession()
    {
        $userId = \Yii::$app->user->identity->username;
        $cache = Yii::$app->cache;
        $history =  Yii::$app->session->get($userId);

        if (!$history) {
            $history = $cache->get($userId);
            Yii::$app->session->set($userId, $history);
        }

        if(Yii::$app->request->url != '/site/history') {

            if (isset($history) && $history) {
                $cache->set($userId, $history);
                if (!isset($history[date('l_F_d-Y')])) {
                    $history[date('l_F_d-Y')] = [[
                        'url' => 'http://lusan.tv/site/about',
                        'time' => date('H:i:s')
                    ]];
                }
                $url = array_reverse($history[date('l_F_d-Y')]);

                if ($url[0]['url'] != Yii::$app->request->absoluteUrl) {
                    array_push($history[date('l_F_d-Y')], [
                        'url' => Yii::$app->request->absoluteUrl,
                        'time' => date('H:i:s')
                    ]);
                    Yii::$app->session->set($userId, $history);
                }
            } else {
                Yii::$app->session[$userId] = [date('l_F_d-Y') => [
                    [
                        'url' => Yii::$app->request->absoluteUrl,
                        'time' => date('H:i:s')
                    ]
                ]];
            }
        }
    }

    /**
     * @param $post
     */
    public static function rating($post)
    {
        if (!Yii::$app->user->isGuest) {

            $model = Rate::findOne([$post['type'] => $post['id'], 'user_id' => Yii::$app->user->id]);
            if (!$model) {
                $model = new Rate();
                if ($post['type'] == 'tv_id') {
                    $model->tv_id = $post['id'];
                } elseif ($post['type'] == 'program_id') {
                    $model->program_id = $post['id'];
                }
                $model->user_id = Yii::$app->user->id;
            }
            $model->rate = $post['rating'];
            $model->save();

            $sum = Rate::find()->where([$post['type'] => $post['id']])->sum('rate');
            $count = Rate::find()->where([$post['type'] => $post['id']])->count();
            $rating = $sum / $count;

            if ($post['type'] == 'tv_id') {
                $tv = Tv::findOne($post['id']);
                $tv->rating = $rating;
                $tv->save();

                echo $tv->rating;
            } elseif ($post['type'] == 'program_id') {
                $program = Program::findOne($post['id']);
                $program->rating = $rating;
                $program->save();

                echo $program->rating;
            }
        } else {
            echo 0;
        }
    }

    public static function favorite($post)
    {
        if (!Yii::$app->user->isGuest) {

            $model = Favorite::findOne([$post['type'] => $post['id'], 'user_id' => Yii::$app->user->id]);
            if (!$model) {
                $model = new Favorite();
                $model->user_id = Yii::$app->user->id;
                if ($post['type'] == 'tv_id') {
                    $model->tv_id = $post['id'];
                } elseif ($post['type'] == 'program_id') {
                    $model->program_id = $post['id'];
                }
                $model->save();
            }else{
                $model->delete();
            }

            echo 1;
        } else {
            echo 0;
        }
    }


    public static function languageUrl(){

        $languages = Language::find()->all();
        $url = Yii::$app->language == 'am' ? Yii::$app->request->url : substr_replace(Yii::$app->request->url, '', 0,3);

        $result = [];
        foreach($languages as $lang){
            if($lang->iso == 'am'){
                $result[] = [
                    'url' => $url == '/' || $url == '' ? '/' : $url,
                    'name' => $lang->name,
                    'flag_path' => $lang->flag_path
                ];
            }else{
                $result[] = [
                    'url' => $url == '/' ? '/'.$lang->iso : '/'.$lang->iso.$url,
                    'name' => $lang->name,
                    'flag_path' => $lang->flag_path
                ];
            }
        }

        return $result;
    }

    public static function lang($url = null){

        if(Yii::$app->language == 'am'){
            $result = $url ? Url::to('/'.$url): Url::to('/');
        }else{
            $result = $url ? Url::to('/'.Yii::$app->language.'/'.$url) : Url::to('/'.Yii::$app->language);
        }

        return $result;
    }

}