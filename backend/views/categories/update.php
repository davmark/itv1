<?php

use common\components\Translate;

/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = 'Update Category: ' . ' ' . Translate::text($model->getLanguagesHasCategories(), 'title');
$this->params['breadcrumbs'][] = ['label' => 'categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Translate::text($model->getLanguagesHasCategories(), 'title'), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="category-update">
    <div class="box box-info">
        <div class="box-body">
            <?= $this->render('_form', [
                'model' => $model,
                'data'   =>  $data,
                'value' => $value,
                'lang'  => $lang,
                'model_lang' => $model_lang,
            ]) ?>

        </div>
    </div>
</div>