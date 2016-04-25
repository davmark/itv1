<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
?>
<div class="container-fluid content">
    <div class="contacts col-xs-12 col-sm-12 col-md-5 col-lg-5">
        <div class="contacts-header"><p><?= Html::encode($this->title)?></p></div>
        <div class="contacts-body">
            <?php $form = ActiveForm::begin(['id' => 'contact_form']); ?>
                <?= $form->field($model, 'name')->textInput(['placeholder' => 'Your Name (required)'])->label(false) ?>
                <?= $form->field($model, 'email')->textInput(['placeholder' => 'E-mail'])->label(false) ?>
                <?= $form->field($model, 'subject')->textInput(['placeholder' => 'Subject'])->label(false) ?>
                <?= $form->field($model, 'body')->textArea(['rows' => 6, 'placeholder' => 'Your Message'])->label(false) ?>
                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-xs-4 col-sm-2 verification-code">{image}</div><div class="col-xs-6 col-sm-4 col-md-offset-3 col-lg-offset-1">{input}</div></div>',
                ])->label(false) ?>
                <?= Html::submitButton('Send Your Message', ['id' => 'contacts_submit_button', 'name' => 'contact-button']) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <div class="map col-xs-12 col-sm-12 col-md-7 col-lg-7">
        <iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1524.0438822329586!2d44.518854349478026!3d40.184860243396734!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x406abce34b89a355%3A0x3c3a245ade3387cc!2sGourmet+Dourme!5e0!3m2!1sru!2sru!4v1417378915590">
        </iframe>
        <div class="icons">
            <div class="col-sm-4 icon"><i class="fa fa-map-marker"></i><span>Garegin Njdeh 15/1, 20</span></div>
            <div class="col-sm-4 icon"><i class="fa fa-phone"></i><span>(+374) 11 111 111</span></div>
            <div class="col-sm-4 icon"><i class="fa fa-envelope"></i><span>info@info.am</span></div>
            <div class="clear"></div>
        </div>
    </div>
</div>