<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\components\Translate;

/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = Translate::text($model->getLanguagesHasCategories(), 'title');
$this->params['breadcrumbs'][] = ['label' => 'categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-view">
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
                        'value' => Translate::text($model->getLanguagesHasCategories(), 'title'),
                    ],
                    'created',
                    'updated',
                ],
            ]) ?>
        </div>
    </div>
</div>