<?php

use common\components\Translate;

/* @var $this yii\web\View */
/* @var $model common\models\Country */

$this->title = 'Update Country: ' . ' ' . Translate::text($model->getLanguagesHasCountries(), 'title');
$this->params['breadcrumbs'][] = ['label' => 'Countries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Translate::text($model->getLanguagesHasCountries(), 'title'), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="country-update">
    <div class="box box-info">
        <div class="box-body">
            <?= $this->render('_form', [
                'model' => $model,
                'lang'  => $lang,
                'model_lang' => $model_lang,
            ]) ?>
        </div>
    </div>
</div>
