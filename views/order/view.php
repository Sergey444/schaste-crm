<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="orders-view">

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
        'options' => ['class' => 'table table-bordered'],
        'attributes' => [
            'id',
            'name',
            'count',
            'unit_price',
            'sum',
            'status',
            'date_start',
            'date_end',
            // 'teacher.name',
            'teacher.fullName',
            'program.name',
            [
                'attribute' => 'customer.child_name',
                'format' => 'raw',
                'value' => Html::a($model->customer->child_name, ['customer/view', 'id' => $model->customer->id]),
            ],
            ['attribute' => 'created_at', 'format' => ['date', 'php:d.m.Y H:i:s']],
            ['attribute' => 'updated_at', 'format' => ['date', 'php:d.m.Y H:i:s']],
        ],
    ]) ?>

    </div>

</div>
