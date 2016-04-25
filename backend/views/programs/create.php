<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Program */

$this->title = 'Create Program';
$this->params['breadcrumbs'][] = ['label' => 'Programs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="program-create">
    <div class="box box-info">
        <div class="box-body">
            <?= $this->render('_form', [
                'model' => $model,
                'shows' => $shows,
            ]) ?>
        </div>
    </div>
</div>
