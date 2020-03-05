<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Dh */

$this->title = Yii::t('app', 'Create record');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Domens and hostings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dh-create">

    <div class="bg-white">
    <h3>Страница добавления записи</h3><hr>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    </div>

</div>
