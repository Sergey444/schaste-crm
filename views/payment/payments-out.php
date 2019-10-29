<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PaymentOut */

$this->title = Yii::t('app', 'Set payment out');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Payments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-create">

    <div class="bg-white">
        <h3>Страница добавления затрат</h3><hr />
        <?= $this->render('_form-out', [
            'model' => $model,
        ]) ?>
    </div>
    
</div>