<?php

use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Program */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    .kv-file-upload.btn.btn-xs.btn-default{
        display: none;
    }
</style>
<div class="program-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'path')->widget(FileInput::classname(), [
        'options' => [
            'accept' => 'image/*',
        ],
        'pluginOptions' => [
            'uploadUrl' => false,
            'maxFileCount' => 1,
            'uploadExtraData' => [
                'id' => $model->id,
            ],
            'initialPreview' => (!$model->isNewRecord && $model->path) ? Html::img(Yii::$app->params['baseUrl'] ."/uploads/programs/small_320-180_$model->path", array('width' => '100%')) : '',
            'allowedFileExtensions' =>  ['jpg', 'png','gif'],
            'showUpload' => false,
            'showRemove' => true,
            'dropZoneEnabled' => true
        ]
    ]);?>

    <?= $form->field($model, 'image_youtube')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shows_id')->widget(Select2::classname(), [
            'data' => $shows,
            'language' => 'en',
            'options' => ['placeholder' => 'Select a state ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>
    <?= $form->field($model, 'status')->checkbox() ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
