<?php

use fedemotta\datatables\DataTables;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Banners';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banner-index">
    <div class="box box-info">
        <div class="box-body">
            <p>
                <?= Html::a('Create Banner', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?= DataTables::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'url:url',
                    'path',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>
