<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\widgets\MaskedInput;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile('@web/js/order-form.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<div class="orders-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Enter order name...')]) ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'sum')->textInput(['type' => 'number', 'placeholder' => Yii::t('app', 'Calculated automatically...')]) ?>
        </div>
        
        <div class="col-md-3">
            <?= $form->field($model, 'count')->textInput(['type' => 'number', 'min' => 1, 'value' => 1]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'unit_price')->textInput(['type' => 'number']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'sale')->textInput(['type' => 'number']) // Скидка ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'date_start')->widget(DatePicker::className(), [
                                                                        'options' => [
                                                                            'class' => 'form-control',
                                                                        ],
                                                                        'clientOptions' => [
                                                                            'minDate' => '',
                                                                            'maxDate' => ''
                                                                        ],
                                                                        'language' => 'ru',
                                                                        'dateFormat' => 'php:d.m.Y',
                                                                ])->widget(MaskedInput::className(), [
                                                                    'mask' => '99.99.9999'
                                                                ])->textInput(['value' => date('d.m.Y')]); ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'date_end')->widget(DatePicker::className(), [
                                                                        'options' => [
                                                                            'class' => 'form-control',
                                                                        ],
                                                                        'clientOptions' => [
                                                                            'minDate' => '',
                                                                            'maxDate' => ''
                                                                        ],
                                                                        'language' => 'ru',
                                                                        'dateFormat' => 'php:d.m.Y',
                                                                ])->widget(MaskedInput::className(), [
                                                                    'mask' => '99.99.9999'
                                                                ])->textInput(['placeholder' => Yii::t('app', 'Not necessary...')]); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'program_id')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'status')->dropDownList(  [
                                                                    1 => 'Создан заказ',
                                                                    2 => 'Заказ в работе',
                                                                    3 => 'Заказ выполнен',
                                                                    4 => 'Заказ отменён'
                                                                ],
                                                                [
                                                                    'prompt' => 'Не установлен ...'
                                                                ]
            ); ?>
        </div>
    </div>

    <hr />
    <div class="row">
        <div class="col-md-4">
            <div>
            
                <?=$form->field($model,'type_customer')->radioList(
                    [
                        'not' => Yii::t('app', 'Don\'t attach customer'), 
                        'new' => Yii::t('app', 'Add new customer'),
                        'old' => Yii::t('app', 'Choose from customer list')
                    ],
                    [
                    'item' => function($index, $label, $name, $checked, $value) {
                        return Html::radio($name,
                                           $checked,
                                           [
                                               'label' => $label,
                                               'labelOptions' => [
                                                    'class' => 'd-block'
                                               ],
                                               'value' => $value,
                                               'href' => '#'.$value,
                                               'data-name' => 'type_customer'

                                           ]);
                    }]
                  ); ?>

            </div>
        </div>

        <div class="col-md-8">
            <div class="row">

                <div class="tab-content">
                    <div class="rs-order__new-customer tab-pane fade in active" id="not"></div>
                    <div class="rs-order__new-customer tab-pane fade in active" id="new">
                        
                        <div class="col-md-4">
                            <?= $form->field($model, 'customer_new_name')->textInput(['placeholder' => Yii::t('app', 'Write a name...')]) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'parents_new_name')->textInput(['placeholder' => Yii::t('app', 'Write a name...')]) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'customer_phone')->widget(MaskedInput::className(), [
                                                                                'mask' => '9 (999) 999-99-99',
                                                                                'clientOptions' => [
                                                                                    'removeMaskOnSubmit' => true,
                                                                                ]
                                                                            ])->textInput(['placeholder' => Yii::t('app', 'Write a phone...')])->label(Yii::t('app', 'Phone'));?>
                        </div>
                    </div>
                    
                    <div class="col-md-12 rs-order__customer tab-pane fade" id="old">
                        <?= $form->field($model, 'customer_name', [
                            'template' => '{label}{input}{error}
                                            <table class="table table-hover rs-add-to-order">
                                                <tbody id="rs-find-block"></tbody>
                                            </table>'
                        ])->textInput(['placeholder' => Yii::t('app', 'Start typing a name...')]) ?>

                        <?= $form->field($model, 'customer_id')->hiddenInput()->label(false) ?>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <hr />

    <?= $form->field($model, 'checkbox_payment')->checkbox(['label' => Yii::t('app', 'Create payment'), 'checked' => true, 'value' => true]);?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
