<?php

use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;


/* @var $this yii\web\View */
/* @var $model common\models\Tv */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    .kv-file-upload.btn.btn-xs.btn-default{
        display: none;
    }
</style>
<div class="tv-form">


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
            'initialPreview' => (!$model->isNewRecord && $model->path) ? Html::img(Yii::$app->params['baseUrl'] ."/uploads/tvs/small_279-155_$model->path") : '',
            'allowedFileExtensions' =>  ['jpg', 'png','gif'],
            'showUpload' => false,
            'showRemove' => true,
            'dropZoneEnabled' => true
        ]
    ]);?>

    <?= $form->field($model, 'status')->radioList(['Passive', 'Active']) ?>
    <?=$form->field($model, 'country_id')->dropDownList($data,['prompt'=>'-Choose a Course-']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
