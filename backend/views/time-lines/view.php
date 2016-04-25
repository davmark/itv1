<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TimeLine */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Time Lines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="time-line-view">
    <div class="box box-info">
        <div class="box-body">
            <p>
                <?= Html::a('Update', ['update', 'id' => $model->id, 'tv_id' => $model->tv_id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id, 'tv_id' => $model->tv_id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'date',
                    'title',
                    'week_days',
                    'start_time',
                    'end_time',
                    'created',
                    'updated',
                    'tv.title',
                ],
            ]) ?>

        </div>
    </div>
</div>