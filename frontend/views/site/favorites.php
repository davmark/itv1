<?php
/**
 * Created by PhpStorm.
 * User: Artur
 * Date: 1/29/2016
 * Time: 5:20 PM
 */
use common\components\Helper;
use common\components\Translate;
use yii\bootstrap\Html;

$this->title = Yii::t('frontend', 'favorites');
?>
<div class="container-fluid favorites-content">
    <div
        class="heading">
        <h1><?=$this->title = Yii::t('frontend', 'favorites');?></h1>
        <div id="favorites-search-form">
            <fieldset>
                <input placeholder="Որոնել" id="favorites-search" type="search">
                <button type="submit" id="favorites-search-submit">
                    <i class="fa fa-search"></i>
                </button>
            </fieldset>
        </div>
    </div>
    <div class="container-fluid favorites-content">
        <?foreach($tvs as $item):?>
            <?if(isset($item->tv->id) && $item->tv->id):?>
                <div class="one-favorite-wrapper col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="one-favorite-inner">
                        <div class="img-wrapper">
                            <?= Html::a(Html::img($item->tv->path ? Yii::$app->params['baseUrl'] ."/uploads/tvs/small_279-155_".$item->tv->path : '/images/no_image.png',
                                [
                                    'title' => Translate::text($item->tv->getLanguagesHasTvs(), 'title'),
                                    'alt'   => Translate::text($item->tv->getLanguagesHasTvs(), 'title'),
                                ]),Helper::lang('tv/'.$item->tv->alias))?>
                        </div>
                        <div class="description-wrapper">
                            <div class="name"><?= Translate::text($item->tv->getLanguagesHasTvs(), 'title')?></div>
                            <div class="desc"><?= Translate::text($item->tv->getLanguagesHasTvs(), 'title')?></div>
                            <div class="date"></div>
                            <div class="fav-button pressed" data-id="<?=$item->id?>" ><i class="fa fa-star"></i></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            <?endif?>
        <?endforeach;?>
    </div>
</div>