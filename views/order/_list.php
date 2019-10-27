<?php

use yii\helpers\Html;

/* @var $model app\models\Order */


?>

<div class="bg-white"> 
    <table class="table">
        <caption class="row"> <span class="col-xs-7"><?= $model->name ?></span> <span class="col-xs-5" style="text-align: right;"><?= Yii::$app->formatter->asDate($model->created_at, 'php:d.m.Y H:i') ?></span></caption>
        <thead></thead>
        <tbody>
            <tr>
                <td><?= Yii::t('app', 'Program') ?></td>
                <td><?= $model->program_id ?></td>
            </tr>

            <tr>
                <td><?= Yii::t('app', 'Customer') ?></td>
                <td><?= $model->customer->child_name ? 
                        Html::a($model->customer->child_name, ['customer/view', 'id' => $model->customer->id], ['data-pjax' => 0]) 
                        : $model->customer_name ?? '<span class="not-set">(не задано)</span>' ?>
                </td>
            </tr>

            <tr>
                <td><?= Yii::t('app', 'Count') ?></td>
                <td><?= $model->count ?></td>
            </tr>
            <tr>
                <td><?= Yii::t('app', 'Sum') ?></td>
                <td><?= $model->sum ?></td>
            </tr>
            <tr>
                <td><?= Yii::t('app', 'Status') ?></td>
                <td><?= $model->status ?? '<span class="not-set">(не задано)</span>' ?></td>
            </tr>
            
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
