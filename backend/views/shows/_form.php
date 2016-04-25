<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $model common\models\Show */
/* @var $form yii\widgets\ActiveForm */
?>

<style>
    .kv-file-upload.btn.btn-xs.btn-default{
        display: none;
    }
</style>

<div class="show-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>

    <?
    foreach($lang as $item){
        $tabs['items'][] =  [
            'label' => $item->name,
            'content' => $this->render('_input', [
                'model' => $model,
                'lang'  => $item,
                'form' => $form,
                'model_lang' => $model_lang,
            ]),
        ];
    }
    ?>
    <?= Tabs::widget($tabs);?>

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
            'initialPreview' => (!$model->isNewRecord && $model->path) ? Html::img(Yii::$app->params['baseUrl'] ."/uploads/shows/small_279-155_$model->path", array('width' => '100%')) : '',
            'allowedFileExtensions' =>  ['jpg', 'png','gif'],
            'showUpload' => false,
            'showRemove' => true,
            'dropZoneEnabled' => true
        ]
    ]);?>
    <div class="form-group field-category-title required">
        <label class="control-label" for="category-title">Categories</label>
        <?echo Select2::widget([
            'name' => 'cat_id',
            'value' => $value,
            'data' => $data,
            'options' => ['multiple' => true, 'placeholder' => 'Select states ...']
        ]);?>
    </div>

    <?= $form->field($model, 'tv_id')->widget(Select2::classname(), [
        'data' => $data_tvs,
        'options' => ['placeholder' => 'Выберите состояние ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>

    <?= $form->field($model, 'status')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
