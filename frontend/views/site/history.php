<?php
/**
 * Created by PhpStorm.
 * User: Artur
 * Date: 1/26/2016
 * Time: 3:00 PM
 */
use yii\bootstrap\Html;
use yii\widgets\ActiveForm;

?>
<div class="container-fluid history-content">
    <div class="heading col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xs-offset-0 col-sm-offset-1 col-md-offset-2 col-lg-offset-3">
        <h1>History</h1>
        <form id="history-search-form">
            <fieldset>
                <input placeholder="Որոնել" id="history-search" type="search">
            </fieldset>
        </form>
    </div>
    <div class="history-content-self col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xs-offset-0 col-sm-offset-1 col-md-offset-2 col-lg-offset-3">
        <?php $form = ActiveForm::begin(['id' => 'contact_form']); ?>
            <div class="buttons">
                <button class="clear-history-btn" name="all" type="submit">Clear history</button>
                <button class="remove-items-history-btn" name="get" type="submit" disabled>Remove selected items</button>
            </div>
            <?if(isset($histories) && $histories):?>
                <?foreach($histories as $date => $item):?>
                    <p class="date"><?=str_replace('_',' ',$date)?></p>
                    <div class="date-area">
                        <?foreach($item as $k => $v):?>
                            <label class="history-result">
                                <input type="checkbox" name="checkbox[<?=$date?>][<?=$k?>1]" value="<?=$k?>">
                                <p class="hour"><?=$v['time']?></p><?= Html::a($v['url'], $v['url'], ['class' => 'name'])?>
                            </label>
                            <br>
                        <?endforeach;?>
                    </div>
                <?endforeach;?>
            <?endif?>
        <?php ActiveForm::end(); ?>
    </div>
</div>
