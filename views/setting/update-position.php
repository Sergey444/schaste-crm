<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Position */

$this->title = Yii::t('app', 'Update position');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Position'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="contacts-update">
    <div class="bg-white">
        <h3>Страница редактирования должности</h3><hr />
        <?= $this->render('_position', [
            'model' => $model,
        ]) ?>
    </div>
</div>