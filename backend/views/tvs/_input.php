<?php
/**
 * Created by PhpStorm.
 * User: Artur
 * Date: 11/16/2015
 * Time: 3:43 PM
 */

use common\components\Translate;

$name = Translate::translatable_key('title', $lang->id);
$name2 = Translate::translatable_key('description', $lang->id);
?>

<?= $form->field($model_lang, 'title')->textInput(['maxlength' => true, 'name' => "lang[$name]", 'value' => Translate::text($model->getLanguagesHasTvs(), 'title', $lang->iso)]) ?>
<?= $form->field($model_lang, 'description')->textArea(['rows' => '6',  'name' => "lang[$name2]", 'value' => Translate::text($model->getLanguagesHasTvs(), 'description', $lang->iso)]) ?>
