<?php

use yii\helpers\Html;
use common\components\Translate;
use fedemotta\datatables\DataTables;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tvs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tv-index">
    <div class="box box-info">
        <div class="box-body">

            <p>
                <?= Html::a('Create Tv', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?= DataTables::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    'id',
                    ['class' => 'yii\grid\SerialColumn'],

                    'alias',
                    [
                        'label' => 'Title',
                        'value' => function($model){ return Translate::text($model->getLanguagesHasTvs(), 'title'); }
                    ],
        //            'description:ntext',
        //            'url:url',
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