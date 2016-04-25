<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\time\TimePicker;
use dosamigos\datepicker\DatePicker;
use yii\db\Expression;

/* @var $this yii\web\View */
/* @var $model common\models\TimeLine */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="time-line-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date')->widget(DatePicker::classname(), [
        'language' => 'en',
        'size' => 'lg',
        'value' => new Expression('NOW()'),
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-m-dd'
        ]
    ]) ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'week_days')->widget(Select2::classname(), [
        'data' => [
            1 => 'Monday',
            2 => 'Tuesday',
            3 => 'Wednesday',
            4 => 'Thursday',
            5 => 'Friday',
            6 => 'Saturday',
            7 => 'Sunday',
        ],
        'options' => ['placeholder' => 'Select a state ...'],
        'pluginOptions' => ['allowClear' => true],
    ]);?>

    <?=$form->field($model, 'start_time')->widget(TimePicker::className(), [

    ]);?>

    <?=$form->field($model, 'end_time')->widget(TimePicker::className(), [ ]);?>

    <?= $form->field($model, 'tv_id')->widget(Select2::classname(), [
        'data' => $data,
        'options' => ['placeholder' => 'Select a state ...'],
        'pluginOptions' => ['allowClear' => true],
    ]);?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
