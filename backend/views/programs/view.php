<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Program */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Programs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="program-view">
    <div class="box box-info">
        <div class="box-body">
            <p>
                <?= Html::a('Update', ['update', 'id' => $model->id, 'shows_id' => $model->shows_id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id, 'shows_id' => $model->shows_id], [
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
                    'title',
                    'alias',
                    'url:url',
                    'path',
                    'image_youtube',
                    'publishedAt',
                    'created',
                    'updated',
                    'status',
                ],
            ]) ?>
        </div>
    </div>
</div>
