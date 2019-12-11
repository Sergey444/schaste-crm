<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\widgets\MaskedInput;
use yii\jui\DatePicker;

$this->registerJsFile('@web/js/order-form.js', ['depends' => [\yii\web\JqueryAsset::className()]]);


/* @var $this yii\web\View */
/* @var $model app\models\PaymentIn */
/* @var $form ActiveForm */
?>
<div class="payment-form-in">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'name') ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'sum')->textInput(['type' => 'number']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'type_of_pay')->dropDownList(  [
                                                                        'Наличными' => 'Наличными',
                                                                        'Безнал на р/счёт' => 'Безнал на р/счёт',
                                                                        'Перевод на карту' => 'Перевод на карту'
                                                                    ],
                                                                    [
                                                                        'prompt' => 'Выберите тип ...'
                                                                    ]
            ); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'customer_id') ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'date_of_payment')->widget(DatePicker::className(), [
                                                                        'options' => [
                                                                            'class' => 'form-control',
                                                                        ],
                                                                        'language' => 'ru',
                                                                        'dateFormat' => 'php:d.m.Y',
                                                                ])->widget(MaskedInput::className(), [
                                                                    'mask' => '99.99.9999'
                                                                ])->textInput(['value' => date('d.m.Y')])->label(Yii::t('app', 'Date Of Payment')); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 rs-order__customer">
                    <?= $form->field($model, 'customer_name', [
                        'template' => '{label}{input}{error}
                                        <table class="table table-hover rs-add-to-order">
                                            <tbody id="rs-find-block" class="rs-find-block"></tbody>
                                        </table>'
                    ])->textInput(['id' => 'order-customer_name', 'placeholder' => Yii::t('app', 'Start typing a name...')])->label(Yii::t('app', 'Child name')) ?>

                    <?= $form->field($model, 'customer_id')->hiddenInput(['id' => 'order-customer_id'])->label(false) ?>
                    <?//= $form->field($model, 'customer_id') ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'comment')->textarea(['rows' => 5, 'placeholder' => 'Ваш комментарий']) ?>
        </div>
    </div>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- payment-form-in -->
