<?php
/**
 * Created by PhpStorm.
 * User: Artur
 * Date: 2/22/2016
 * Time: 16:38
 */
use common\components\Helper;

use yii\helpers\Html;

$this->title = $title_search;
?>
<div class="container-fluid">
    <div class="channel-block">
        <h4><?=$result_text?></h4>
        <? foreach ($result as $item): ?>
            <div class="one-channel col-xs-12 col-sm-4 col-md-3 col-lg-2">
                <?= Html::img($item['path'] ? Yii::$app->params['baseUrl'] . "/uploads/programs/small_320-180_" . $item['path'] : $item['image_youtube'],
                    [
                        'alt' => $item['title'],
                    ])
                ?>
                <a href="<?= Helper::lang('program/' . $item['alias'].'/'.$item['shows']['alias'])?>" class="one-channel-hover">
                    <p><?= $item['title']?></p>
                </a>
            </div>
        <? endforeach; ?>
        <div class="clear"></div>
    </div>
</div>
