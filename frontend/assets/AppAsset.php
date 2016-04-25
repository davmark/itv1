<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'bootstrap/css/font-awesome.min.css',
       // 'bootstrap/css/bootstrap.min.css',
        'css/owl.carousel.css',
        'css/perfect-scrollbar.min.css',
        'css/style.css',
    ];
    public $js = [
        'js/plaer.js',
        'js/owl.carousel.min.js',
        'js/perfect-scrollbar.jquery.min.js',
        'js/perfect-scrollbar.min.js',
        'bootstrap/js/bootstrap.min.js',
        'js/script.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    public $jsOptions = [
        'position' =>  View::POS_END,
    ];
}