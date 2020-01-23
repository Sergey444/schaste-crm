<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Group */

use yii\helpers\Url;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
// \yii\web\YiiAsset::register($this);
?>
<div class="group-view">

    <div class="d-flex">
        <div class="bg-white av-block mg-right" >
            <div class="av-preview">
                <img src="<?= $model->teacher->photo ? Url::to([$model->teacher->photo], true) : 'https://via.placeholder.com/200'?>" alt="">
                <div class="u-controll">
                    <?= Html::a( $model->teacher->fullName, ['profile/view', 'id' => $model->teacher->id], ['class' => 'u-update-btn']) ?>
                    <?//= Html::a( Yii::t('app', 'Update group'), ['update', 'id' => $model->id], ['class' => 'u-update-btn']) ?>
                </div>
            </div>
        </div>
        <div class="bg-white u-info-block">
            <table class="table table-bordered">
                <caption><?= $this->title ?></caption>
                <tbody>
                    <tr>
                        <td><?= Yii::t('app', 'Program') ?>:</td>
                        <td><?= $model->program->name ?></td>
                    </tr>
                    <tr>
                        <td><?= Yii::t('app', 'Comment') ?>:</td>
                        <td><?= $model->comment ?></td>
                    </tr>
                    <tr>
                        <td><?= Yii::t('app', 'Created At') ?>:</td>
                        <td><?= Yii::$app->formatter->asDate($model->created_at, 'php:d.m.Y') ?></td>
                    </tr>
                    <tr>
                        <td><?= Yii::t('app', 'Updated At') ?>:</td>
                        <td><?= Yii::$app->formatter->asDate($model->updated_at, 'php:d.m.Y') ?></td>
                    </tr>
                </tbody>
            </table>
            <?= Html::a( Yii::t('app', 'Update group'), ['update', 'id' => $model->id], ['class' => 'u-update-btn']) ?>
        </div>
    </div>

    <div class="mg-top">
        <div class="bg-white u-reg-block">
            <table class="table table-bordered">
                <caption><?= Yii::t('app', 'Student list') ?></caption>
                <tbody>
                <thead>
                        <tr>
                            <th>#</th>
                            <th><?= Yii::t('app', 'Child name') ?></th>
                            <th></th>
                        </tr>
                            
                    </thead>
                    <tbody>
                    <?if ($model->customers):?>
                        <?foreach ($model->customers as $key => $customer):?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td>
                                    <?= Html::a( $customer->customer->child_name,
                                    ['customer/view', 'id' => $customer->customer->id] 

                                    ) ?>
                                </td>
                                <td>
                                    <?= Html::a(
                                        '<span class="glyphicon glyphicon-trash"></span>', 
                                        [
                                            'group/delete-child', 
                                            'id' => $customer->id, 
                                            'group_id' => $model->id
                                        ], 
                                        [
                                            'class' => '',
                                            'data' => [
                                                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?')]
                                        ]
                                    )?>
                                </a>
                                </td>
                            </tr>
                        <?endforeach?>
                        <?else:?>
                            <tr><td colspan="3"><?= Yii::t('app', 'Nothing found') ?></td></tr>
                        <?endif?>

                </tbody>
            </table>
        </div>
    </div>

</div>
