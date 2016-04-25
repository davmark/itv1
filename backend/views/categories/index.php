<?php

use yii\helpers\Html;
use common\components\Translate;
use fedemotta\datatables\DataTables;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">
    <div class="box box-info">
        <div class="box-body">

            <p>
                <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?= DataTables::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    'alias',
                    [
                        'label' => 'Title',
                        'value' => function($model){ return Translate::text($model->getLanguagesHasCategories(), 'title'); }
                    ],
                    'created',
                    'updated',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>

        </div>
    </div>
</div>