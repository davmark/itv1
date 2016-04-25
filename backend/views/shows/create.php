<?php

/* @var $this yii\web\View */
/* @var $model common\models\Show */

$this->title = 'Create Show';
$this->params['breadcrumbs'][] = ['label' => 'Shows', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="show-create">
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