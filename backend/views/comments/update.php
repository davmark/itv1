<?php

/* @var $this yii\web\View */
/* @var $model common\models\Comment */

$this->title = 'Update Comment: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="comment-update">
    <div class="box box-info">
        <div class="box-body">
            <?= $this->render('_form', [
                'model' => $model,
                'data' => $data,
            ]) ?>
        </div>
    </div>
</div>