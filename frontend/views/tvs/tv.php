<?php

/* @var $this yii\web\View */

use common\components\Helper;
use common\components\Translate;
use kartik\rating\StarRating;
use yii\bootstrap\Html;

$this->title = Translate::text($tv->getLanguagesHasTvs(), 'title');
$this->image = Yii::$app->params['baseUrl'] ."uploads/tvs/".$tv->path;

?>
<div class="container-fluid player">
    <div class="player-self col-xs-12 col-sm-12 col-md-7 col-lg-7">
        <?= Html::img('/images/logo.png', ['class' => 'img'])?>
        <span class="tvs_player" id="programs"></span>
        <div class="facebook-like">
            <div style="float: right" class="fb-like" data-href="<?=Yii::$app->request->absoluteUrl?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
        </div>
    </div>
    <div class="video-queue col-xs-12 col-sm-12 col-md-5 col-lg-5">
        <div class="logo-div">
            <?=Html::img($tv->path ? Yii::$app->params['baseUrl'] ."/uploads/tvs/small_279-155_".$tv->path : '/images/no_image.png',
                [
                    'alt'   => Translate::text($tv->getLanguagesHasTvs(), 'title')
                ])?>
        </div>
        <div class="queue-search">
            <form id="queue-search-form">
                <fieldset>
                    <input placeholder="Որոնել" id="queue-search" type="text">
                </fieldset>
            </form>
        </div>
        <div id="queue-scrollbar" class="queue-div">
            <div class="queue-self">
                <?foreach($programs as $item):?>
                    <?= Html::a(
                        "<div class='vid-img'>"
                        .Html::img($item->path ? Yii::$app->params['baseUrl'] ."/uploads/programs/small_279-155_".$item->path : $item->image_youtube,
                            ['alt' => $item->title]).
                        "<i class='fa fa-play'></i>
                        </div>
                        <div class='vid-desc'>
                            <p class='name'>".$item->title."</p>
                            <p class='date'>".$item->publishedAt."</p>
                        </div>",
                        Helper::lang('program/'.$item->alias.'/'.$item->shows->alias),
                        ['class' => 'queue-vid']
                    )?>
                <?endforeach?>
            </div>
        </div>
    </div>
</div>

<div class="clearout"></div>
<br>
<?foreach($program_categories as $item):?>
    <?if(!empty($item->programs)):?>
        <div class="container-fluid slide_lang channel-category slide_<?= $item->alias ?>  program_slide">
            <h4><?= Html::a(Translate::text($item->getLanguagesHasShows(), 'title'), Helper::lang('program/' . $item->programs[0]->alias .'/'. $item->alias ))?></h4>
            <div class="slider-wrapper">
                <div id="<?=$item->alias?>" class="slider owl-carousel">
                    <?foreach($item->programs as $i):?>
                        <div id="<?=$item->alias?><?=$i->id?>" class="item <?=$item->alias?> slide zoom_img">
                            <div class="up">
                                <?=Html::img($i->path ? Yii::$app->params['baseUrl'] ."/uploads/programs/small_279-155_".$i->path : $i->image_youtube,
                                    [   'class' => 'lazyOwl',
                                        'title' => Translate::text($item->getLanguagesHasShows(), 'title'),
                                        'alt'   => Translate::text($item->getLanguagesHasShows(), 'title'),
                                    ])
                                ?>
                                <?=Html::a('', Helper::lang('program/'.$i->alias.'/'.$item->alias), ['class' => 'play fa fa-play-circle-o'])?>
                            </div>
                            <div class="down">
                                <p class="date"><?=$i->created?></p>
                                <p class="name"><?= $i->title?></p>
                                <?=Html::a('', '#', ['class' => $item->alias.'_more more fa fa-angle-down'])?>
                                <p class="views" id="ret_<?=$i->id?>"><span><?= $i->rating?></span> <?=Yii::t('frontend', 'rating')?></p>
                            </div>
                        </div>
                    <?endforeach?>
                </div>
            </div>
            <div id="preview_cont">
                <div class="<?=$item->alias?>-preview channel_preview">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 description">
                        <div class="list_left">
                            <h3 class="preview-channel-name"></h3>
                            <form>
                                <?= StarRating::widget([
                                    'name' => 'rating',
                                    'value' => '',
                                    'pluginOptions' => [
                                        'disabled'=> Yii::$app->user->isGuest ? true : false,
                                        'showCaption' => false,
                                        'showClear'=>false,
                                        'step' => 1,
                                    ]
                                ]);?>
                            </form>
                            <p class="preview-channel-info"></p>
                            <a class="preview-channel-link" href="#"><i class="fa fa-plus"></i></a>
                            <input type="hidden" class="input-for-id" value="">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 preview-image">
                        <img class="channel-image" src="" alt="">
                        <div class="list_right">
                            <a href="#"><i class="fa fa-play-circle-o"></i></a>
                        </div>
                    </div>
                    <i class="close-preview fa fa-times"></i>
                </div>
            </div>
        </div>
        <div class="clearout"></div>
    <?endif?>
<?endforeach?>

<div class="clearout"></div>
<script>
    var title = "<?= Translate::text($tv->getLanguagesHasTvs(), 'title')?>";
    var url = "<?=$tv->url?>";
    var tvs = <?=$json?> ;
</script>