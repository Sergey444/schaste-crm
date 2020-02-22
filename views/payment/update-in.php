<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Contacts */

$this->title = Yii::t('app', 'Update payment in');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Payments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="contacts-update">
    <div class="bg-white">
        <h3>Страница редактирования оплаты</h3><hr />
        <?= $this->render('_form-in', [
            'model' => $model,
        ]) ?>
    </div>
</div>