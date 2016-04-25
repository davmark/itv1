<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\components\Helper;
use common\components\Translate;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta property="og:url" content="<?=Yii::$app->request->absoluteUrl?>" />
        <meta property="og:title" content="<?=Html::encode($this->title) ?>" />
        
        <meta name="mailru-domain" content="oxa0jy7B9ia1qVge" />

        <link rel="shortcut icon" type="image/x-icon"
              href="http://avior-systems.ru/wp-content/uploads/2015/11/favicon-2.png">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>

    <nav class="main-navbar navbar navbar-inverse">
        <div class="container-fluid">
            <div class="col-xs-12 col-sm-3 col-md-2 col-lg-2">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#main_navbar_menus" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?= Html::a(Html::img('/images/logo.png'), Helper::lang(), ['class' => 'navbar-logo']) ?>
            </div>

            <div class="collapse navbar-collapse navbar-menu col-xs-12 col-sm-12 col-md-10 col-lg-10"
                 id="main_navbar_menus">
                <ul class="nav navbar-nav navbar_menu">
                    <li class="search-div">

                        <? $form = ActiveForm::begin([ 'action' => Helper::lang('search'), 'method' => 'post', 'id' => 'search-form']);?>
                            <fieldset>
                                <input placeholder="Որոնել" id="search" name="searchwords" type="search">
                                <button type="submit" id="search-submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </fieldset>
                        <? ActiveForm::end(); ?>
                    </li>
                    <li><?= Html::a(Yii::t('frontend', 'home'),Helper::lang() ) ?></li>
                    <li><?= Html::a(Yii::t('frontend', 'about'), Helper::lang('site/about')) ?></li>
                    <li><?= Html::a(Yii::t('frontend', 'contact'), Helper::lang('site/contact')) ?></li>
                </ul>

                <ul class="nav navbar-nav registration-bar">
                    <div class="navbar-left">
                        <? if (Yii::$app->user->isGuest): ?>
                            <?= Html::a(Yii::t('frontend', 'signup'), Helper::lang('site/signup'), ['class' => 'sign-up']) ?>
                            <?= Html::a(Yii::t('frontend', 'login'), Helper::lang('site/login'), ['class' => 'log-in']) ?>
                        <? else: ?>
                            <?= Html::a(Yii::$app->user->identity->username, '#', ['class' => 'log-in profile-exit']) ?>
                            <div class="hidden-menu hide">
                                <ul>
                                    <li><?= Html::a(Yii::t('frontend', 'history'), Helper::lang('site/history'))?></li>
                                    <li><?= Html::a(Yii::t('frontend', 'favorites'), Helper::lang('site/favorites'))?></li>
                                    <li><?= Html::a(Yii::t('frontend', 'watchlist'), Helper::lang('site/watchlist'))?></li>
<!--                                    <li>--><?////Html::a(Yii::t('frontend', 'settings'), '/site/settings')?><!--</li>-->
                                    <li><?= Html::a(Yii::t('frontend', 'logout'), Helper::lang('site/logout'), ['data-method' => 'post']) ?></li>
                                </ul>
                            </div>
                        <? endif; ?>
                    </div>
                </ul>

                <ul class="nav navbar-nav navbar-right language-links">
                    <?foreach(Helper::languageUrl() as $lang):?>
                        <li>
                            <?=Html::a(Html::img($lang['flag_path'], ['alt' => $lang['name']]),$lang['url'])?>
                        </li>
                    <?endforeach;?>

                </ul>
            </div>
        </div>
    </nav>


    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <?= Alert::widget() ?>
    <div class="wrap">
        <?= $content ?>
    </div>

    <div class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="copyright">
                        <a href="/"><i class="fa fa-copyright"></i> Powered by <span>2016 Lusan.tv</span></a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="paying-services">
                        <ul>
                            <li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-mastercard"></i> </a></li>
                            <li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>