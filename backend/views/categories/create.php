<?php

/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = 'Create Category';
$this->params['breadcrumbs'][] = ['label' => 'categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-create">
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