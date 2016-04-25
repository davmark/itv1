<?php

/* @var $this yii\web\View */

use common\components\Helper;
use common\components\Translate;
use kartik\rating\StarRating;
use yii\bootstrap\Html;

$this->title = 'Lusan Tv';
?>
<?if(!empty($sliders)):?>
    <div id="main-slider" class="carousel slide" data-ride="carousel">

        <ol class="carousel-indicators">
            <?foreach($sliders as $key => $slider):?>
                <li data-target="#carousel-example-generic" data-slide-to="<?=$key?>" class="<?=$key == 0 ? 'active' : '' ?>"></li>
            <?endforeach;?>
        </ol>

        <div class="carousel-inner" role="listbox">
            <?foreach($sliders as $key => $slider):?>
                <a href="<?=$slider->url?>" class="item <?=$key == 0 ? 'active' : '' ?>">
                    <img src="<?='uploads/sliders/'.$slider->id.'/'.$slider->image?>" alt="Slider<?$slider->id?>">
                    <div class="carousel-caption">
                    </div>
                </a>
            <?endforeach;?>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#main-slider" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#main-slider" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
<?endif?>
<?foreach($countries_tvs as $item):?>
    <?if(!empty($item->tvs)):?>
        <div class="container-fluid slide_lang slide_<?= $item->alias ?> tv_slide">
            <div class="slider-wrapper">

                <h4><?= Html::a(Translate::text($item->getLanguagesHasCountries(), 'title'), Helper::lang('tvs/'.$item->alias))?></h4>
                <div id="<?=$item->alias?>" class="slider owl-carousel">
                    <?foreach($item->tvs as $i):?>
                        <div id="<?=$item->alias?><?=$i->id?>" class="item <?=$item->alias?> slide zoom_img">
                            <?=Html::img($i->path ? Yii::$app->params['baseUrl'] ."/uploads/tvs/small_279-155_".$i->path : '/images/no_image.png',
                                [   'class' => 'lazyOwl',
                                    'title' => Translate::text($item->getLanguagesHasCountries(), 'title'),
                                    'alt'   => Translate::text($item->getLanguagesHasCountries(), 'title'),
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

                            <?= StarRating::widget([
                                'name' => 'url',
                                'value' => '',
                                'pluginOptions' => [
                                    'disabled'=> Yii::$app->user->isGuest ? true : false,
                                    'showCaption' => false,
                                    'showClear'=>false,
                                ]
                            ]);?>

                            <p class="preview-channel-info"></p>
                            <a class="preview-channel-link" href="javascript:void(0)"><i class="fa fa-plus"></i></a>
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
    <div class="container-fluid slide_lang slide_category">
        <h4> <?=Html::a(Yii::t('frontend','CATEGORIES'), Helper::lang('categories'))?></h4>
        <div class="slider-wrapper">
            <div id="category-slider" class="slider owl-carousel">
                <?foreach($categories as $item):?>
                    <?= Html::a(Html::img($item->path ? Yii::$app->params['baseUrl'] ."/uploads/categories/small_279-155_".$item->path : '/images/no_image.png',
                        [   'class' => 'lazyOwl',
                            'title' => Translate::text($item->getLanguagesHasCategories(), 'title'),
                            'alt'   => Translate::text($item->getLanguagesHasCategories(), 'title'),
                        ])."
                        <div class='category-name'>
                            <i class=\"$item->icon\"></i>
                            <span>".Translate::text($item->getLanguagesHasCategories(), 'title')."</span>
                        </div>
                        "
                        , Helper::lang('category/' . $item->alias),
                        ['id' => 'category'.$item->id,
                         'class' => 'category',
                        ]);
                    ?>
                <?endforeach?>
            </div>
        </div>
    </div>
<?endif;?>
<script>
    var tvs = <?=$tvs?>;
</script>