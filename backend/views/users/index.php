<?php

use yii\helpers\Html;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <div class="box box-info">
        <div class="box-body">
            <?= DataTables::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'username',
                    //'auth_key',
                    //'password_hash',
                    //'password_reset_token',
                     'email:email',
                     'created_at:date',
                     'updated_at:date',
                    [
                        'label' => 'status',
                        'format' =>'html',
                        'value' => function($model){ return $model->status ? 'Active' : 'Passive'; }
                    ],
                    [
                        'label' => 'Role',
                        'format' =>'html',
                        'value' => function($model){ return $model->role ? 'Admin' : 'User'; }
                    ],

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>

        </div>
    </div>
</div>