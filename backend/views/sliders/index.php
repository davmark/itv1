<?php

use fedemotta\datatables\DataTables;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sliders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banner-index">
    <div class="box box-info">
        <div class="box-body">
            <p>
                <?= Html::a('Create Slider', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?= DataTables::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'url:url',
                    'image',
                    'created',
                    'updated',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>
