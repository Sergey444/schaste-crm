<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'child_name', ['enableAjaxValidation' => true])->textInput() ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'parents_name')->textInput(['maxlength' => true]) ?>
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
    </div>

    <div class="row">
                        
        <div class="col-md-6">
            <div>
                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
            </div>
            <div>
                <? $model->birthday = Yii::$app->formatter->asDate($model->birthday, 'php:d.m.Y'); ?>
                <?=
                    $form->field($model, 'birthday')->widget(MaskedInput::className(), [
                        'mask' => '99.99.9999',
                    ])->label(Yii::t('app', 'Date of birthday'));
                ?>
            </div>
        </div>
        <div class="col-md-6 ">
            <?= $form->field($model, 'comment')->textArea(['rows' => 5]) ?>
        </div>
    </div>

     <br>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save') , ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
