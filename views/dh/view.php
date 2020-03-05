<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Dh */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Domens and hostings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="dh-view">

    <div class="bg-white mg-bottom">
    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    </div>

    <div class="bg-white u-info-block">

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'name',
                'host',
                'port',
                'login_ftp',
                'password_ftp',
                'login_panel',
                'password_panel',
                ['attribute' => 'created_at', 'format' => ['date', 'php:d.m.Y H:i:s']],
                ['attribute' => 'updated_at', 'format' => ['date', 'php:d.m.Y H:i:s']],
            ],
        ]) ?>

    </div>

</div>
