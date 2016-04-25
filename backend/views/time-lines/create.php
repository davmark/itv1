<?php

/* @var $this yii\web\View */
/* @var $model common\models\TimeLine */

$this->title = 'Create Time Line';
$this->params['breadcrumbs'][] = ['label' => 'Time Lines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="time-line-create">
    <div class="box box-info">
        <div class="box-body">
            <?= $this->render('_form', [
                'model' => $model,
                'data' => $data,
            ]) ?>

        </div>
    </div>
</div>