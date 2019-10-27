<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */

$this->title = Yii::t('app', 'Create Order');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-create">

    <div class="bg-white">
    <h3>Страница добавления заказа</h3><hr>
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>

</div>
