<?php

use fedemotta\datatables\DataTables;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Programs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="program-index">
    <div class="box box-info">
        <div class="box-body">
            <p>
                <?= Html::a('Create Program', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?= DataTables::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'title',
                    'alias',
                    //'url:url',
                    // 'path',
                    // 'image_youtube',
                     'publishedAt',
                    // 'created',
                     'updated',
                     'status',
                     'shows_id',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>
