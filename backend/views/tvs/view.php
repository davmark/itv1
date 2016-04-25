<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\components\Translate;

/* @var $this yii\web\View */
/* @var $model common\models\Tv */

$this->title = Translate::text($model->getLanguagesHasTvs(), 'title');
$this->params['breadcrumbs'][] = ['label' => 'Tvs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tv-view">
    <div class="box box-info">
        <div class="box-body">
            <p>
                <?= Html::a('Update', ['update', 'id' => $model->id, 'country_id' => $model->country_id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id, 'country_id' => $model->country_id], [
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
                        'value' => Translate::text($model->getLanguagesHasTvs(), 'title'),
                    ],
                    'url:url',
                    [
                        'label' => 'Status',
                        'format' =>'html',
                        'value' => $model->status ? 'Active' : 'Passive',
                    ],
                    'created',
                    'updated',
                ],
            ]) ?>

        </div>
    </div>
</div>