<?php

/* @var $this yii\web\View */
/* @var $model common\models\TimeLine */

$this->title = 'Update Time Line: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Time Lines', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id, 'tv_id' => $model->tv_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="time-line-update">
    <div class="box box-info">
        <div class="box-body">
            <?= $this->render('_form', [
                'model' => $model,
                'data' => $data,
            ]) ?>

        </div>
    </div>
</div>