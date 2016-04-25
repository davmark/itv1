<?php
/**
 * Created by PhpStorm.
 * User: Artur
 * Date: 1/27/2016
 * Time: 2:39 PM
 */
use common\components\Helper;
use common\components\Translate;
use yii\helpers\Html;

?>

<div class="header-div">
    <h4 class="channel-header col-xs-12 col-sm-6 col-md-6 col-lg-6"><?= Yii::t('frontend', 'CATEGORIES')?></h4>
    <div id="search-channel" class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <fieldset>
            <input placeholder="Որոնել" id="search-channel-input" type="search">
        </fieldset>
    </div>
    <div class="clear"></div>
</div>
<div class="container-fluid">
    <div class="channel-block">
        <? foreach ($categories as $item): ?>
            <div class="one-channel col-xs-12 col-sm-4 col-md-3 col-lg-2">
                <?= Html::img($item->path ? Yii::$app->params['baseUrl'] . "/uploads/categories/small_279-155_" . $item->path : '/images/no_image.png',
                    [
                        'alt' => Translate::text($item->getLanguagesHasCategories(), 'title')
                    ])
                ?>
                <a href="<?= Helper::lang('category/' . $item->alias)?>" class="one-channel-hover">
                    <p><?= Translate::text($item->getLanguagesHasCategories(), 'title')?></p>
                </a>
            </div>
        <? endforeach; ?>
        <div class="clear"></div>
    </div>
</div>