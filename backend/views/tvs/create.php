<?php

/* @var $this yii\web\View */
/* @var $model common\models\Tv */

$this->title = 'Create Tv';
$this->params['breadcrumbs'][] = ['label' => 'Tvs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tv-create">
    <div class="box box-info">
        <div class="box-body">
            <?=$this->render('_form', [
                'model' => $model,
                'lang'  => $lang,
                'data'  =>  $data,
                'model_lang' => $model_lang,
            ])?>
        </div>
    </div>
</div>
