<?php

use yii\helpers\Html;
use \yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Position */
/* @var $form ActiveForm */

use  app\models\Program;
use  app\models\PositionProgram;

$modelPositionProgram = new PositionProgram();
$programs = ArrayHelper::map(Program::find()->all(), 'id', 'name');
?>

<div class="setting-_position">

    <?php $form = ActiveForm::begin(); ?>

        <div class="row">
            <div class="col-md-8 ">
                <?= $form->field($model, 'name')->label(Yii::t('app', 'Title')) ?>
            </div>
            <div class="col-md-4">
                <div class="form-group mg-top-25">
                    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary d-block']) ?>
                </div>
            </div>
        </div>

        <div>
            <?= $form->field($model, 'show_teacher')->checkbox(['label' => Yii::t('app', 'Show users with this position in the list of teachers'), 'value' => true]); ?>
        </div>

        <?= $form->field($model, 'programs.program_id')->checkboxList($programs, ['value' => true]); ?>
        <?//= Html::activeCheckboxList($modelPositionProgram, 'program_id', $programs, []) ?>

    
    <?php ActiveForm::end(); ?>

</div><!-- setting-_position -->
