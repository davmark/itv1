<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">
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
                    'username',
                    //'auth_key',
                    //'password_hash',
                    //'password_reset_token',
                    'created_at:date',
                    'updated_at:date',
                    'email:email',
                    [
                        'label' => 'status',
                        'format' =>'html',
                        'value' => $model->status ? 'Active' : 'Passive',
                    ],
                    [
                        'label' => 'Role',
                        'format' =>'html',
                        'value' => $model->role ? 'Admin' : 'User',
                    ],
                ],
            ]) ?>

        </div>
    </div>
</div>