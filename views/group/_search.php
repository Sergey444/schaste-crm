<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GroupSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="group-search">

<?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    'options' => [
        'data-pjax' => 1
    ],
]); ?>

<div class="row">
    <div class="col-xs-8">
        <?= $form->field($model, 'term')->textInput(['autocomplete' => 'off', 'placeholder' => Yii::t('app', 'Search')])->label(false) ?>
    </div>
    <div class="col-xs-4" >
         <?= Html::submitButton(Yii::t('app', 'Find'), ['class' => 'btn btn-primary d-block']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

</div>
