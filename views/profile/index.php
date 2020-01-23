<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Personal */

$this->title =  Yii::t('app', 'My profile');
$this->params['breadcrumbs'][] = Yii::t('app', 'Profile');
?>
<div class="personal-view">

    <div class="d-flex mg-bottom">
        <div class="bg-white av-block mg-right mg-bottom" >
            <div class="av-preview">
                <img src="<?= file_exists($model->photo) ? '/' . $model->photo : 'https://via.placeholder.com/200' ?>" alt="">
                <div class="u-controll">
                    <?php if (Yii::$app->user->id == $model->user_id):?>
                        <?= Html::a( Yii::t('app', 'Update profile'), ['update'], ['class' => 'u-update-btn']) ?>
                    <?php else:?>
                        <?= Html::a( Yii::t('app', 'Update profile'), ['update-user', 'id' => $model->id], ['class' => 'u-update-btn']) ?>
                    <?php endif?>
                </div>
            </div>
        </div>
        <div class="bg-white u-info-block">
            <table class="table table-bordered">
                <caption><?= $model->fullName?></caption>
                <tbody>

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
                        <td><?= Yii::t('app', 'Teacher') ?></td>
                        <td><?= $model->teacher ? 'Да' : 'Нет' ?></td>
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
                        <td><?= Yii::t('app', 'User role')?>:</td>
                        <td><?= Yii::t('app', array_key_first ( Yii::$app->authManager->getRolesByUser($model->user->id) )); ?></td>
                    </tr>
                    <tr>
                        <td><?= Yii::t('app', 'Date of registration')?>:</td>
                        <td><?= Yii::$app->formatter->asDate($model->created_at, 'php:d.m.Y H:i:s')?></td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-white">
        <table class="table table-bordered">
            <caption><?= Yii::t('app', 'Class information')?></caption>
            <tbody>
                <tr>
                    <td><?//= Yii::t('app', 'Company name')?></td>
                    <td><?//= Yii::t('app', $model->user->company->name ) ?></td>
                </tr>
                <tr>
                    <td><?//= Yii::t('app', 'Company count people')?></td>
                    <td><?//= Yii::t('app', $model->user->company->count_people ) ?></td>
                </tr>
                <tr>
                    <td><?//= Yii::t('app', 'Company open year')?></td>
                    <td><?//= Yii::t('app', $model->user->company->open_year ) ?></td>
                </tr>
            </tbody>
        </table>
    </div>

</div>