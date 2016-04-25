<?php

use common\components\Translate;
use fedemotta\datatables\DataTables;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Countries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country-index">
    <div class="box box-info">
        <div class="box-body">

            <p>
                <?= Html::a('Create Country', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?= DataTables::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    [
                        'label' => 'Title',
                        'value' => function($model){ return Translate::text($model->getLanguagesHasCountries(), 'title');}
                    ],
                    'alias',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>
