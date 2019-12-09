<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Registration');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>
    <p><?= Yii::t('app', 'Please fill out the following fields to signup') ?>:</p>

    <div class="row">
        <div class="bg-white">
            <div class="col-lg-5">
                <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                    <?= $form->field($model, 'email')->textInput()->label(Yii::t('app', 'Email')) ?>

                    <?= $form->field($model, 'name')->textInput()->label(Yii::t('app', 'Name')) ?>

                    <?= $form->field($model, 'password')->passwordInput()->label(Yii::t('app', 'Password')) ?>

                    <?= $form->field($model, 'password_repeat')->passwordInput()->label(Yii::t('app', 'Password repeat')) ?>

                    <div class="form-group">
                        <?= Html::submitButton(Yii::t('app', 'To signup'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
