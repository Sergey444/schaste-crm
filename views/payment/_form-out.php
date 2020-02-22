<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\widgets\MaskedInput;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\PaymentOut */
/* @var $form ActiveForm */
?>
<div class="payment-form-out">

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
            <div class="col-md-4">
                <?= $form->field($model, 'date_of_payment')->widget(DatePicker::className(),[
                                                                                                'options' => [
                                                                                                    'class' => 'form-control',
                                                                                                ],
                                                                                                'language' => 'ru',
                                                                                                'dateFormat' => 'php:d.m.Y',
                                                                                            ])->widget(MaskedInput::className(), [
                                                                                                'mask' => '99.99.9999'
                                                                                            ])->textInput(['value' => $model->date_of_payment ? date('d.m.Y', $model->date_of_payment) : date('d.m.Y')])->label(Yii::t('app', 'Date Of Payment')); ?>
            </div>
            <div class="col-md-8">
                <?= $form->field($model, 'comment')->textarea(['rows' => 1, 'placeholder' => 'Ваш комментарий']) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'salary')->checkbox(['label' => Yii::t('app', 'Salary (set if payment is salary)'), 'value' => true]);?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- payment-form-out -->
