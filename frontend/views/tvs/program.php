<?php

/* @var $this yii\web\View */


use common\components\Helper;
use common\components\Translate;
use kartik\rating\StarRating;
use yii\bootstrap\Html;

$this->title = $program->title;
$this->image = $program->path ? Yii::$app->params['baseUrl'].'uploads/programs/'.$program->path : $program->image_youtube

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
            <?=Html::img($program->path ? '/uploads/programs/small_120-90_'.$program->path : $program->image_youtube,[
                'title' => $program->title,
                'alt'   => $program->title
            ])?>
        </div>
        <div class="queue-search">
            <div id="queue-search-form">
                <fieldset>
                    <input placeholder="Որոնել" id="queue-search" type="text">
                </fieldset>
            </div>
        </div>
        <div id="queue-scrollbar" class="queue-div">
            <div class="queue-self">
                <?foreach($programs as $item):?>
                    <?= Html::a(
                        "<div class='vid-img'>"
                        .Html::img($item->path ? '/uploads/programs/small_120-90_'.$item->path : $item->image_youtube,['alt' => $item->title]).
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
<?foreach($countries_tvs as $item):?>
    <?if(!empty($item->tvs)):?>
        <div class="container-fluid slide_lang slide_<?= $item->alias ?> tv_slide">
            <h4><?= Html::a(Translate::text($item->getLanguagesHasCountries(), 'title'), Helper::lang('tvs/'.$item->alias)) ?></h4>
            <div class="slider-wrapper">
                <div id="<?=$item->alias?>" class="slider owl-carousel">
                    <?foreach($item->tvs as $i):?>
                        <div id="<?=$item->alias?><?=$i->id?>" class="item <?=$item->alias?> slide zoom_img">
                            <?=Html::img($i->path ? Yii::$app->params['baseUrl'] ."/uploads/tvs/small_279-155_".$i->path : '/images/no_image.png',
                                [   'class' => 'lazyOwl',
                                    'title' => Translate::text($item->getLanguagesHasCountries(), 'title'),
                                    'alt'   => Translate::text($item->getLanguagesHasCountries(), 'title')
                                ])
                            ?>
                            <?=Html::a('', Helper::lang('tv/'.$i->alias), ['class' => 'play fa fa-play-circle-o'])?>
                            <?=Html::a('', '#', ['class' => $item->alias.'_more more fa fa-angle-down'])?>
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
                                    'name' => 'url',
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

<?if(!empty($banners)):?>
    <div class="container-fluid govazd">
        <div class="slider-wrapper">
            <div id="govazd-slider" class="slider owl-carousel">
                <?foreach($banners as $item):?>
                    <?= Html::a(Html::img($item->path ? Yii::$app->params['baseUrl'] ."/uploads/banners/small_700-100_".$item->path : '/images/govazd1.jpg',
                        [   'class' => 'lazyOwl',
                            'title' => 'banner'.$item->id,
                            'alt'   => 'banner'.$item->id,
                        ]),
                        Helper::lang($item->url),
                        ['class' => 'govazd-banner'])
                    ?>
                <?endforeach?>
            </div>
        </div>
    </div>
<?endif;?>
<div class="clearout"></div>

<?if(!empty($categories)):?>
    <div class="container-fluid slide_category">
        <div class="slider-wrapper">
            <div id="category-slider" class="slider owl-carousel">
                <?foreach($categories as $item):?>
                    <?= Html::a(Html::img($item->path ? Yii::$app->params['baseUrl'] ."/uploads/categories/small_279-155_".$item->path : '/images/no_image.png',
                            [   'class' => 'lazyOwl',
                                'title' => Translate::text($item->getLanguagesHasCategories(), 'title'),
                                'alt'   => Translate::text($item->getLanguagesHasCategories(), 'title')
                            ])."
                    <div class='category-name'>
                        <i class=\"$item->icon\"></i>
                        <span>".Translate::text($item->getLanguagesHasCategories(), 'title')."</span>
                    </div>
                    "
                        , Helper::lang('category/'.$item->alias),
                        ['id' => 'category'.$item->id,
                            'class' => 'category',
                        ]);
                    ?>
                <?endforeach;?>
            </div>
        </div>
    </div>
<?endif;?>

<script>
    var title = "<?=$program->title?>";
    var url = "<?=filter_var($program->url, FILTER_VALIDATE_URL) ? $program->url : 'https://www.youtube.com/watch?v='.$program->url?>";
    var tvs = <?=$tvs?>;
</script>