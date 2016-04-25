<?php

/* @var $this yii\web\View */

use common\components\Helper;
use common\components\Translate;
use yii\bootstrap\Html;

$this->title = Translate::text($country->getLanguagesHasCountries(), 'title');

?>

<div class="header-div">
    <h4 class="channel-header col-xs-12 col-sm-6 col-md-6 col-lg-6"><?= Translate::text($country->getLanguagesHasCountries(), 'title')?></h4>
    <div id="search-channel" class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <fieldset>
            <input placeholder="Որոնել" id="search-channel-input" type="search">
        </fieldset>
    </div>
    <div class="clear"></div>
</div>
<div class="container-fluid">
    <div class="channel-block">
        <? foreach ($tvs as $item): ?>
            <div class="one-channel col-xs-12 col-sm-4 col-md-3 col-lg-2">
                <?= Html::img($item->path ? Yii::$app->params['baseUrl'] . "/uploads/tvs/small_279-155_" . $item->path : '/images/no_image.png',
                    [
                        'alt' => Translate::text($item->getLanguagesHasTvs(), 'title')
                    ])
                ?>
                <a href="<?= Helper::lang('tv/' . $item->alias)?>" class="one-channel-hover">
                    <p><?= Translate::text($item->getLanguagesHasTvs(), 'title')?></p>
                </a>
            </div>
        <? endforeach; ?>
        <div class="clear"></div>
    </div>
</div>