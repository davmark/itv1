<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Slider */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    .kv-file-upload.btn.btn-xs.btn-default{
        display: none;
    }
</style>
<div class="slider-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->widget(FileInput::classname(), [
        'options' => [
            'accept' => 'image/*',
        ],
        'pluginOptions' => [
            'uploadUrl' => false,
            'maxFileCount' => 1,
            'uploadExtraData' => [
                'id' => $model->id,
            ],
            'initialPreview' => (!$model->isNewRecord && $model->image) ? Html::img(Yii::$app->params['baseUrl'] ."uploads/sliders/$model->id/$model->image", ['width' => '100%']) : '',
            'allowedFileExtensions' =>  ['jpg', 'png','gif'],
            'showUpload' => false,
            'showRemove' => true,
            'dropZoneEnabled' => true
        ]
    ]);?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
