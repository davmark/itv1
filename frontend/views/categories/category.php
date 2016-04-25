<?php
/**
 * Created by PhpStorm.
 * User: Artur
 * Date: 1/27/2016
 * Time: 3:05 PM
 */
use common\components\Helper;
use common\components\Translate;
use yii\bootstrap\Html;

$this->title = Translate::text($category->getLanguagesHasCategories(), 'title');

?>

<div class="header-div">
    <h4 class="channel-header col-xs-12 col-sm-6 col-md-6 col-lg-6"><?= Translate::text($category->getLanguagesHasCategories(), 'title')?></h4>
    <div id="search-channel" class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <fieldset>
            <input placeholder="Որոնել" id="search-channel-input" type="search">
        </fieldset>
    </div>
    <div class="clear"></div>
</div>
<div class="container-fluid">
    <div class="channel-block">
        <? foreach ($shows as $item): ?>
            <div class="one-channel col-xs-12 col-sm-4 col-md-3 col-lg-2">
                <? if(isset($item->programs[0]->alias)):?>
                    <?= Html::img($item->path ? Yii::$app->params['baseUrl'] . "/uploads/shows/small_279-155_" . $item->path : '/images/no_image.png',
                        [
                            'alt' => Translate::text($item->getLanguagesHasShows(), 'title'),
                        ])
                    ?>
                    <a href="<?= Helper::lang('program/' . $item->programs[0]->alias .'/'. $item->alias) ?>" class="one-channel-hover">
                        <p><?= Translate::text($item->getLanguagesHasShows(), 'title') ?></p>
                    </a>
                <?endif;?>
            </div>
        <? endforeach; ?>
        <div class="clear"></div>
    </div>
</div>