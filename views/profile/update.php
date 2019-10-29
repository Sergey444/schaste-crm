<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Personal */

$this->title = Yii::t('app','Update Profile');

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Profile'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');

$this->registerJsFile('@web/js/personal.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

?>
<div class="personal-update">

    <?= $this->render('_personal', [
        'model' => $model,
    ]) ?>

    <?= $this->render('_user', [
        'user' => $user,
    ]) ?>

</div>
