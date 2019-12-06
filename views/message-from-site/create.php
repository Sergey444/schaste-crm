<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MessageFromSite */

$this->title = Yii::t('app', 'Create Message From Site');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Message From Sites'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-from-site-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
