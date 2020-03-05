<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Dh */

$this->title = Yii::t('app', 'Update Dh: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Domens and hostings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="dh-update">

    <div class="bg-white">
        <h3>Страница редактирования записи</h3><hr />
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>

</div>
