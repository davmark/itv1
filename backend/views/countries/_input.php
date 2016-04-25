<?php
/**
 * Created by PhpStorm.
 * User: Artur
 * Date: 11/16/2015
 * Time: 3:43 PM
 */
use common\components\Translate;
$name = Translate::translatable_key('title', $lang->id);
?>

<?= $form->field($model_lang, 'title')->textInput(['maxlength' => true, 'name' => "lang[$name]", 'value' => Translate::text($model->getLanguagesHasCountries(), 'title', $lang->iso)]) ?>

