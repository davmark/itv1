<?php

use common\components\Translate;

/* @var $this yii\web\View */
/* @var $model common\models\Tv */

$this->title = 'Update Tv: ' . ' ' . Translate::text($model->getLanguagesHasTvs(), 'title');
$this->params['breadcrumbs'][] = ['label' => 'Tvs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Translate::text($model->getLanguagesHasTvs(), 'title'), 'url' => ['view', 'id' => $model->id, 'country_id' => $model->country_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tv-update">
    <div class="box box-info">
        <div class="box-body">
            <?=$this->render('_form', [
                'model' => $model,
                'lang'  => $lang,
                'data'  =>  $data,
                'model_lang' => $model_lang,
            ])?>
        </div>
    </div>
</div>