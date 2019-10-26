<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\widgets\MaskedInput;
use yii\jui\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Personal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personal-form bg-white">

    <h3>Регистрационные данные</h3>
    <hr />

    <?php $form = ActiveForm::begin(); ?>
    <p>Редактировать email запрещено, для изменения, пожалуйста обратитесь к администратору</p>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($user, 'email')->textInput(['disabled' => true])->label(Yii::t('app', 'Email')) ?>
        </div>
    </div>
    <hr />
    
    <? if (Yii::$app->user->can('admin')): ?>
    <p>Раздел администратора, пользователи его не видят.</p>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($user, 'status')->textInput(['maxlength' => true])->label(Yii::t('app', 'Status')) ?>
        </div>
        <div class="col-md-6">
            <?// $user->availability = Yii::$app->formatter->asDate($user->availability , 'php:d.m.Y'); ?>
            <?/*= $form->field($user, 'availability')->widget(DatePicker::className(), [
                                                                    'value' => date('d.m.Y'),
                                                                    'options' => [
                                                                        'class' => 'form-control'
                                                                    ],
                                                                    'language' => 'ru',
                                                                    'dateFormat' => 'php:d.m.Y',
                                                            ])->widget(MaskedInput::className(), [
                                                                'mask' => '99.99.9999',
                                                            ])->label(Yii::t('app', 'Availability')); */?>
        </div>
    </div><hr/>
    <? endif ?>
    
    <p>Установите пароль для входа в приложение. Должно быть не менее 6 символов.</p>
    <p>Заполните поля ниже только если вы хотите сменить свой пароль.</p>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($user, 'password')->passwordInput()->label(Yii::t('app', 'Password')) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($user, 'password_repeat')->passwordInput()->label(Yii::t('app', 'Password repeat')) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app','Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>