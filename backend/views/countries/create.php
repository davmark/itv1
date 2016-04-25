<?php

/* @var $this yii\web\View */
/* @var $model common\models\Country */

$this->title = 'Create Country';
$this->params['breadcrumbs'][] = ['label' => 'Countries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country-create">
    <div class="box box-info">
        <div class="box-body">
            <?= $this->render('_form', [
                'model' => $model,
                'lang'  => $lang,
                'model_lang' => $model_lang,
            ]) ?>
        </div>
    </div>
</div>
