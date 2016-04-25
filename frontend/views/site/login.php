<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */


use common\components\Helper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\authclient\widgets\AuthChoice;
$this->title = Yii::t('frontend', 'login');
?>
<div class="container-fluid sign-up-content">
    <div
        class="heading col-xs-12 col-sm-10 col-md-8 col-lg-6 col-xs-offset-0 col-sm-offset-1 col-md-offset-2 col-lg-offset-3">
        <span><?= Html::encode($this->title) ?></span>
    </div>
    <div
        class="sign-up-square col-xs-12 col-sm-8 col-md-6 col-lg-4 col-xs-offset-0 col-sm-offset-2 col-md-offset-3 col-lg-offset-4">
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
                    <?= $form->field($model, 'username')->textInput() ?>
                </div>
                <div class="signup-div signup-pass-div">
                    <i class="fa fa-key"></i>
                    <?= $form->field($model, 'password')->passwordInput() ?>
                </div>
                <?// $form->field($model, 'rememberMe')->checkbox() ?>
                <?= Html::submitButton(Yii::t('frontend', 'login'), ['id' => 'signup_submit_button', 'name' => 'login-button']) ?>
                <div class="forgot">

                    <?= Html::a("<i class='fa fa-unlock'></i><span>".Yii::t('frontend', 'forgot password?')."</span>",
                        [Helper::lang('site/request-password-reset')],
                        ['class'=> 'col-sm-6']) ?>
                    <?=Html::a("<i class='fa fa-arrow-circle-down'></i><span>".Yii::t('frontend', 'signup')."</span>",
                        Helper::lang('site/signup'), ['class' => 'col-sm-6'])?>

                </div>
                <div class="clear"></div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>