<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\components\Translate;

/* @var $this yii\web\View */
/* @var $model common\models\Show */

$this->title = Translate::text($model->getLanguagesHasShows(), 'title');
$this->params['breadcrumbs'][] = ['label' => 'Shows', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="show-view">
    <div class="box box-info">
        <div class="box-body">
            <p>
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
                    'alias',
                    [
                        'label' => 'Title',
                        'value' => Translate::text($model->getLanguagesHasShows(), 'title'),
                    ],
                    'url:url',
                    'created',
                    'updated',
                    [
                        'label' => 'status',
                        'format' =>'html',
                        'value' =>  $model->status ? 'Active' : 'Passive',
                    ],
                ],
            ]) ?>

        </div>
    </div>
</div>