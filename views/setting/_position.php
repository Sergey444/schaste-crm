<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Position */
/* @var $form ActiveForm */
?>
<div class="setting-_position">

    <?php $form = ActiveForm::begin(); ?>

        <div class="row">
            <div class="col-md-8">
                <?= $form->field($model, 'name')->label(Yii::t('app', 'Title')) ?>
            </div>
            <div class="col-md-4">
                <div class="form-group mg-top-25">
                    <?= Html::submitButton(Yii::t('app', 'Add new position'), ['class' => 'btn btn-primary d-block']) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <?= $form->field($model, 'show_teacher')->checkbox(['label' => Yii::t('app', 'Show users with this position in the list of teachers'), 'value' => true]); ?>
            </div>
        </div>
    
    <?php ActiveForm::end(); ?>

</div><!-- setting-_position -->
