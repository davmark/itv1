<?php
/**
 * Created by PhpStorm.
 * User: Artur
 * Date: 1/20/2016
 * Time: 2:12 PM
 */

namespace frontend\models;

use common\components\Translate;
use common\models\Show;
use common\models\Tv;
use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class Json extends Model
{
    /**
     * @return Json
     */
    static public function tvsJson()
    {
        $tvs = Tv::find()->all();

        $json_tvs = [];

        foreach($tvs as $item){
            $json_tvs[$item->id]['id'] =  $item->id;
            $json_tvs[$item->id]['title'] =  Translate::text($item->getLanguagesHasTvs(), 'title');
            $json_tvs[$item->id]['alias'] = '/tv/'.$item->alias;
            $json_tvs[$item->id]['description'] = Translate::text($item->getLanguagesHasTvs(), 'description');
            $json_tvs[$item->id]['path'] = $item->path ? Yii::$app->params['baseUrl'] ."/uploads/tvs/small_279-155_".$item->path : '/images/no_image.png';
            $json_tvs[$item->id]['rating'] = $item->rating ;
        }

        return json_encode($json_tvs);
    }

    static public function programsJson($tv_id)
    {
        $json = [];
        
        $category_programs = Show::find()
            ->joinWith('programs')
            ->where(['shows.tv_id' => $tv_id, 'shows.status' => 1,'programs.status' => 1])
            ->orderBy(['programs.publishedAt' => SORT_DESC])
            ->all();

        foreach($category_programs as $item){
            foreach($item->programs as $i){
                $json[$i->id]['id'] =  $i->id;
                $json[$i->id]['title'] =  $i->title;
                $json[$i->id]['alias'] = '/program/'.$i->alias.'/'.$item->alias;
                $json[$i->id]['description'] = '';
                $json[$i->id]['path'] = $i->path ? '/uploads/programs/small_320-180_'.$i->path : $i->image_youtube;
                $json[$i->id]['rating'] = $i->rating ;
            }
        }


        return json_encode($json);
    }
}
