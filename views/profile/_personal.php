<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

use yii\jui\DatePicker;

use app\models\Position;

/* @var $this yii\web\View */
/* @var $model app\models\Personal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personal-form bg-white mg-bottom">

    <h3>Данные пользователя</h3>
    <p>Задайте данные пользователя, чтобы другие могли его узнать</p><hr />

    <?php $form = ActiveForm::begin(); ?>

    <div class="d-flex">

        <div class="u-info-block">
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'surname')->textInput(['maxlength' => true])->label(Yii::t('app', 'Surname')) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label(Yii::t('app', 'Name')) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'secondname')->textInput(['maxlength' => true])->label(Yii::t('app', 'Secondname')) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <? $model->date_of_birthday = Yii::$app->formatter->asDate($model->date_of_birthday, 'php:d.m.Y'); ?>
                    <?=
                        $form->field($model, 'date_of_birthday')->widget(MaskedInput::className(), [
                            'mask' => '99.99.9999',
                        ])->label(Yii::t('app', 'Date of birthday'));

                    ?>
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

                <div class="col-md-4">
                    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
                </div>
            </div>

            <div class="row">
                <?if ($model->position->show_teacher):?>
                    <div class="col-md-4">
                        <?= $form->field($model, 'color')->textInput(['type' => 'color'])->label(Yii::t('app', 'Calendar color')) ?>
                    </div>
                <?endif?>
                <div class="col-md-4">
                    <?$positions = ArrayHelper::map(Position::find()->all(), 'id', 'name');?>
                    <?= $form->field($model, 'position_id')->dropDownList($positions, ['prompt' => Yii::t('app', 'Не выбрана')]) ?>
                </div>
                <div class="col-md-4" style="margin-top: 25px;">
                    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>

        <div class="bg-white av-block mg-left">
            <div class="av-preview">
                <img src="<?= file_exists($model->photo) ? '/' . $model->photo : 'https://via.placeholder.com/200'?>" id="img-preview" alt="">
                <div class="edit-photo-block">
                    <div class="rs-pencil">
                    <span class="glyphicon glyphicon-pencil" onclick="$('#add-photo-input').click()"></span>
                    </div>
                    <?= $form->field($model, 'img')->fileInput(['class'=>'add-photo-input', 'id'=>"add-photo-input"])->label(false) ?>
                </div>
            </div>
        </div>

    </div>





    <?php ActiveForm::end(); ?>

</div>
