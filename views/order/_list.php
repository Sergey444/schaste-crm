<?php

use yii\helpers\Html;

/* @var $model app\models\Order */


?>

<div class="bg-white">
    <table class="table">
        <caption class="row"> <span class="col-xs-7"><?= $model->name ?></span> <span class="col-xs-5" style="text-align: right;">Дата оплаты: <?= Yii::$app->formatter->asDate($model->payment->date_of_payment, 'php:d.m.Y') ?></span></caption>
        <thead></thead>
        <tbody>
            <tr>
                <td><?= Yii::t('app', 'Child name') ?></td>
                <td><?= $model->customer->child_name ? Html::a($model->customer->child_name, ['customer/view', 'id' => $model->customer->id], ['data-pjax' => 0]) : '<span class="not-set">(не задано)</span>'?></td>
            </tr>

            <tr>
                <td><?= Yii::t('app', 'Teacher') ?></td>
                <td><?= $model->teacher->id ? Html::a($model->teacher->fullName, ['profile/view', 'id' => $model->teacher->id], ['data-pjax' => 0]) : '<span class="not-set">(не задано)</span>'?></td>
            </tr>

            <tr>
                <td><?= Yii::t('app', 'Program') ?></td>
                <td><?= $model->program->name ? Html::a($model->program->name, ['program/view', 'id' => $model->program->id], ['data-pjax' => 0]) : '<span class="not-set">(не задано)</span>' ?></td>
            </tr>

            <tr>
                <td><?= Yii::t('app', 'Count') ?></td>
                <td><?= $model->count ?></td>
            </tr>
            <tr>
                <td><?= Yii::t('app', 'Sum') ?></td>
                <td><?= Yii::$app->formatter->format($model->sum, ['decimal', 0]) ?> р.</td>
            </tr>
            <tr>
                <td><?= Yii::t('app', 'Payment') ?></td>
                <td><?= $model->payment->name ? Html::a($model->payment->name, ['customer/view', 'id' => $model->payment->id], ['data-pjax' => 0]) : '<span class="not-set">(не задано)</span>'?></td>
            </tr>
            <tr>
                <td><?= Yii::t('app', 'Date Start') ?></td>
                <td><?= Yii::$app->formatter->asDate($model->date_start, 'php:d.m.Y') ?></td>
            </tr>
            <tr>
                <td><?= Yii::t('app', 'Created At') ?></td>
                <td><?= Yii::$app->formatter->asDate($model->created_at, 'php:d.m.Y H:i') ?></td>
            </tr>
    <?/*
    <tr>
        <td><?= Yii::t('app', 'Status') ?></td>
        <td><?= $model->status ?? '<span class="not-set">(не задано)</span>' ?></td>
    </tr>
    */?>

        </tbody>
    </table>
    <div style="text-align: right;">
        <?= Html::a(
            '<span class="glyphicon glyphicon-eye-open"></span>',
            ['view', 'id' => $model->id],
            ['data-pjax' => 0]
        )?>

        <?= Html::a(
            '<span class="glyphicon glyphicon-pencil"></span>',
            ['update', 'id' => $model->id],
            ['data-pjax' => 0]
        )?>
        <?= Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $model->id], [
                'class' => '',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                    'pjax' => 0
                ],
        ]) ?>
    </div>
</div>
