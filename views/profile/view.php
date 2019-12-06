<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Personal */

$this->title = $model->name;
$this->params['breadcrumbs'][] =  Yii::t('app', 'Profile');
// \yii\web\YiiAsset::register($this);
?>
<div class="personal-view">

    <div class="d-flex">
        <div class="bg-white av-block mg-right" >
            <div class="av-preview">
                <img src="<?= $model->photo ? Url::to([$model->photo], true) : 'https://via.placeholder.com/200'?>" alt="">
                <div class="u-controll">
                    <?= Html::a( Yii::t('app', 'Update profile'), ['update'], ['class' => 'u-update-btn']) ?>
                </div>
            </div>
        </div>
        <div class="bg-white u-info-block">
            <table class="table table-bordered">
                <caption><?= Yii::t('app', 'Main information')?></caption>
                <tbody>
                    <tr>
                        <td><?= Yii::t('app', 'Surname') ?>:</td>
                        <td><?= $model->surname ?></td>
                    </tr>
                    <tr>
                        <td><?= Yii::t('app', 'Name') ?>:</td>
                        <td><?= $model->name ?></td>
                    </tr>
                    <tr>
                        <td><?= Yii::t('app', 'Secondname') ?>:</td>
                        <td><?= $model->secondname ?></td>
                    </tr>
                    <tr>
                        <td><?= Yii::t('app', 'Date of birthday') ?>:</td>
                        <td><?= Yii::$app->formatter->asDate($model->date_of_birthday, 'php:d.m.Y') ?></td>
                    </tr>
                    <tr>
                        <td><?= Yii::t('app', 'Phone') ?>:</td>
                        <td><?= $model->phone ?></td>
                    </tr>
                    <tr>
                        <td><?= Yii::t('app', 'Email') ?></td>
                        <td><?= $model->user->email ?></td>
                    </tr>
                    <tr>
                        <td><?= Yii::t('app', 'City') ?>:</td>
                        <td><?//= $model->phone ?></td>
                    </tr>
                    <tr>
                        <!-- <td><?//= Yii::t('app', 'Email') ?></td>
                        <td><?//= $model->user ?></td> -->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="mg-top">
        <div class="bg-white u-reg-block">
            <table class="table table-bordered">
                <caption><?= Yii::t('app', 'Registration data')?></caption>
                <tbody>
                    <tr>
                        <td><?= Yii::t('app', 'Date of registration')?>:</td>
                        <td><?= Yii::$app->formatter->asDate($model->created_at, 'php:d.m.Y H:i:s')?></td>
                    </tr>
                    <tr>
                        <td><?= Yii::t('app', 'Status')?>:</td>
                        <td><?= $model->user->status ?></td>
                    </tr>
                    <?/*if ($model->user->availability && $model->user->status === 8):?>
                        <tr>
                            <td><?= Yii::t('app', 'Availability')?>:</td>
                            <td><?= Yii::$app->formatter->asDate($model->user->availability, 'php:d.m.Y') ?></td>
                        </tr>
                    <?endif*/?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<?php
/*
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Personal */
/*
$this->title = $model->name;
if (Yii::$app->user->can('admin')) {
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Personals'), 'url' => ['users']];
}
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="personal-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a( Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a( Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'surname',
            'name',
            'secondname',
            [
                'attribute' => 'date_of_birthday',
                'value' => function ($data) {
                    $string = $data->date_of_birthday;
                    return substr($string, 0, 2) .'/'. substr($string, 2, 2) .'/'. substr($string, 4) ;
                }
            ],
            'phone',
            ['attribute' => 'created_at', 'format' => ['date', 'php:d.m.Y H:i:s']],
            ['attribute' => 'updated_at', 'format' => ['date', 'php:d.m.Y H:i:s']],
        ],
    ]) ?>

</div>
