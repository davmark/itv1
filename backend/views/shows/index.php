<?php

use yii\helpers\Html;
use common\components\Translate;
use fedemotta\datatables\DataTables;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Shows';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="show-index">
    <div class="box box-info">
        <div class="box-body">

            <p>
                <?= Html::a('Create Show', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?= DataTables::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'alias',
                    [
                        'label' => 'Title',
                        'value' => function($model){ return Translate::text($model->getLanguagesHasShows(), 'title'); }
                    ],
                    'url:url',
                    //'description:ntext',
                     'created',
                     'updated',
                    [
                        'label' => 'status',
                        'format' =>'html',
                        'value' => function($model){ return $model->status ? 'Active' : 'Passive'; }
                    ],

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>

        </div>
    </div>
</div>