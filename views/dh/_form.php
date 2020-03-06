<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Dh */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dh-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'host')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'port')->textInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'login_ftp')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'password_ftp')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'login_panel')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'password_panel')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'comment')->textarea(['rows' => 5, 'placeholder' => Yii::t('app', 'Your comment') .' ...']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4"><?= $form->field($model, 'host_name')->textInput(['maxlength' => true]);?></div>
        <div class="col-md-4"><?= $form->field($model, 'host_login')->textInput(['maxlength' => true]);?></div>
        <div class="col-md-4"><?= $form->field($model, 'host_password')->textInput(['maxlength' => true]);?></div>
    </div>

    <div class="row">
        <div class="col-md-4"><?= $form->field($model, 'db_name')->textInput(['maxlength' => true]);?></div>
        <div class="col-md-4"><?= $form->field($model, 'db_login')->textInput(['maxlength' => true]);?></div>
        <div class="col-md-4"><?= $form->field($model, 'db_password')->textInput(['maxlength' => true]);?></div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?//= $form->field($model, 'cms_id')->textInput();?>
        </div>
    </div>
    
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
