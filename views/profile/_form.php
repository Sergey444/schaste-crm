<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\widgets\MaskedInput;


/* @var $this yii\web\View */
/* @var $model app\models\Personal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?//= $form->field($model, 'username')->textInput(['autofocus' => true])->label(Yii::t('app', 'Username')) ?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'email')->textInput(['autofocus' => true])->label(Yii::t('app', 'Email')) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'password')->passwordInput()->label(Yii::t('app', 'Password')) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'password_repeat')->passwordInput()->label(Yii::t('app', 'Password repeat')) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'surname')->textInput(['maxlength' => true])->label(Yii::t('app', 'Surname')) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label(Yii::t('app', 'Name')) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'secondname')->textInput(['maxlength' => true])->label(Yii::t('app', 'Secondname')) ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-4">
        <?=
            $form->field($model, 'date_of_birthday')->widget(MaskedInput::className(), [
                'mask' => '99.99.9999',
            ])->label(Yii::t('app', 'Date of birthday'));
        ?>
        </div>
        <div class="col-md-4">
        <?=
            $form->field($model, 'phone')->widget(MaskedInput::className(), [
                'mask' => '+9 (999) 999-99-99',
                'clientOptions' => [
                    'removeMaskOnSubmit' => true,
                ]
            ])->label(Yii::t('app', 'Phone'));
        ?>
        </div>
        <div class="col-md-4"></div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app','Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
