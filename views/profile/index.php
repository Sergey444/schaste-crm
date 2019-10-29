<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Personal */

$this->title =  Yii::t('app', 'My profile');
$this->params['breadcrumbs'][] = Yii::t('app', 'Profile');
// \yii\web\YiiAsset::register($this);
?>
<div class="personal-view">

    <div class="d-flex mg-bottom">
        <div class="bg-white av-block mg-right mg-bottom" >
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
                        <td><?= Yii::$app->formatter->asPhone($model->phone); ?></td>
                    </tr>
                    <tr>
                        <td><?= Yii::t('app', 'Email') ?></td>
                        <td><?= $model->user->email ?></td>
                    </tr>
                    <tr>
                        <td><?= Yii::t('app', 'Address') ?>:</td>
                        <td><?= $model->address ?></td>
                    </tr>
                    <tr>
                        <!-- <td><?//= Yii::t('app', 'Email') ?></td>
                        <td><?//= $model->user ?></td> -->
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="mg-bottom">
        <div class="bg-white u-reg-block">
            <table class="table table-bordered">
                <caption><?= Yii::t('app', 'Registration data')?></caption>
                <tbody>
                    <tr>
                        <td><?= Yii::t('app', 'Status')?>:</td>
                        <td><?= Yii::t('app', $model->user->status ) ?></td>
                    </tr>
                    <tr>
                        <td><?= Yii::t('app', 'Status')?>:</td>
                        <td><?   Yii::$app->authManager->getRolesByUser($model->user->id); ?></td>
                    </tr>
                    <tr>
                        <td><?= Yii::t('app', 'Date of registration')?>:</td>
                        <td><?= Yii::$app->formatter->asDate($model->created_at, 'php:d.m.Y H:i:s')?></td>
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
   
    <div class="bg-white">
        <table class="table table-bordered">
            <caption><?= Yii::t('app', 'Company information')?></caption>
            <tbody>
                <tr>
                    <td><?//= Yii::t('app', 'Company name')?>:</td>
                    <td><?//= Yii::t('app', $model->user->company->name ) ?></td>
                </tr>
                <tr>
                    <td><?//= Yii::t('app', 'Company count people')?>:</td>
                    <td><?//= Yii::t('app', $model->user->company->count_people ) ?></td>
                </tr>
                <tr>
                    <td><?//= Yii::t('app', 'Company open year')?>:</td>
                    <td><?//= Yii::t('app', $model->user->company->open_year ) ?></td>
                </tr>
            </tbody>
        </table>
    </div>

</div>