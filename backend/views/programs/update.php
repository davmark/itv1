<?php

/* @var $this yii\web\View */
/* @var $model common\models\Program */

$this->title = 'Update Program: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Programs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id, 'shows_id' => $model->shows_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="program-update">
    <div class="box box-info">
        <div class="box-body">
            <?= $this->render('_form', [
                'model' => $model,
                'shows' => $shows,
            ]) ?>
        </div>
    </div>
</div>
