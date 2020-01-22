<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use \yii\helpers\ArrayHelper;

use \app\models\Program;
use \app\models\Profile;

/* @var $this yii\web\View */
/* @var $model app\models\Group */
/* @var $form yii\widgets\ActiveForm */

$programs = ArrayHelper::map(Program::find()->all(), 'id', 'name');
$teachers = ArrayHelper::map(Profile::find()->where(['teacher' => 1])->all(), 'id', 'fullName');

if (empty($teachers)) {
    $errors[] = '- создать <a href="/profile/users">преподавателей</a>.';
}

if (empty($programs)) {
    $errors[] = '- создать <a href="/program">программы</a>.';
}

?>

<div class="group-form">

    <?php if (isset($errors)):?>
        <div class="alert alert-info">
            <strong>Информация!<br> Для создания группы необходимо:</strong><br>
            <?php foreach($errors as $error):?>
                <?= $error ?> <br>
            <?php endforeach?>
            <br>
            <div>Либо обратитесь к администратору системы <a href="mailto:info@schaste-club.ru">info@schaste-club.ru</a></div>
        </div>
    <?php else:?>

        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12">
                        <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Enter group name ...')]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7">
                        <?= $form->field($model, 'teacher_id')->dropDownList($teachers, ['prompt' => Yii::t('app', 'Choose teacher ...')]) ?>
                    </div>
                    <div class="col-md-5">
                        <?= $form->field($model, 'program_id')->dropDownList($programs, ['prompt' => Yii::t('app', 'Choose program ...')]) ?>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <?= $form->field($model, 'comment')->textarea(['rows' => 5, 'placeholder' => Yii::t('app', 'Your comment') .' ...']) ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    <?php endif?>

</div>
