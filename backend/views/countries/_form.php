<?php

use yii\bootstrap\Tabs;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Country */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="country-form">
    <?php $form = ActiveForm::begin(); ?>
    <?
    foreach($lang as $item){
        $tabs['items'][] =  [
            'label' => $item->name,
            'content' => $this->render('_input', [
                'model' => $model,
                'model_lang' => $model_lang,
                'lang'  => $item,
                'form' => $form,
            ]),
        ];
    }
    ?>
    <?= Tabs::widget($tabs);?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
