<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Program */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="program-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Enter program name').' ...']) ?>
                    <?= $form->field($model, 'one_price')->textInput(['type' => 'number', 'maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'comment')->textarea(['rows' => 5, 'placeholder' => Yii::t('app', 'Your comment') .' ...']) ?>
                </div>
            </div>
        </div>
    </div>

    <br>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
