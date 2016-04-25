<?php

use yii\helpers\Html;
use common\components\Translate;

/* @var $this yii\web\View */
/* @var $model common\models\Show */

$this->title = 'Update Show: ' . ' ' . Translate::text($model->getLanguagesHasShows(), 'title');
$this->params['breadcrumbs'][] = ['label' => 'Shows', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Translate::text($model->getLanguagesHasShows(), 'title'), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="show-update">
    <div class="box box-info">
        <div class="box-body">
            <?= $this->render('_form', [
                'model' => $model,
                'data'   => $data,
                'value' => $value,
                'lang'  => $lang,
                'data_tvs' => $data_tvs,
                'model_lang' => $model_lang,
            ]) ?>

        </div>
    </div>
</div>