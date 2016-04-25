<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\authclient\widgets\AuthChoice;

$this->title = Yii::t('frontend', 'signup');
?>

<div class="container-fluid sign-up-content">
    <div class="heading col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xs-offset-0 col-sm-offset-1 col-md-offset-2 col-lg-offset-3">
        <span><?= Yii::t('frontend', 'signup')?></span>
    </div>
    <div class="sign-up-square col-xs-12 col-sm-8 col-md-6 col-lg-4 col-xs-offset-0 col-sm-offset-2 col-md-offset-3 col-lg-offset-4">
        <div class="sign-up-form">
            <div class="first-block">
                <div class="user-logo"><i class="fa fa-user"></i></div>
                <?= AuthChoice::widget([
                    'baseAuthUrl' => ['site/auth']
                ]) ?>
            </div>
            <?php $form = ActiveForm::begin(['id' => 'signup_form']); ?>
            <div class="signup-div signup-name-div">
                <i class="fa fa-user"></i>
                <?= $form->field($model, 'username') ?>
            </div>
            <div class="signup-div signup-email-div">
                <i class="fa fa-envelope"></i>
                <?= $form->field($model, 'email') ?>
            </div>
            <div class="signup-div signup-pass-div">
                <i class="fa fa-key"></i>
                <?= $form->field($model, 'password')->passwordInput() ?>
            </div>
            <?= Html::submitButton(Yii::t('frontend', 'register'), ['id' => 'signup_submit_button', 'name' => 'signup-button']) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>