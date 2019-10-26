<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Contacts */

$this->title = $model->child_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contacts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="contacts-view">

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

    <div class="bg-white">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'child_name',
                [
                    'attribute' => 'phone',
                    'value' => function($model) {
                         return Yii::$app->formatter->asPhone($model->phone);
                    },
                ],
                'email:email',
                'comment:ntext',
                ['attribute' => 'birthday', 'format' => ['date', 'php:d.m.Y']],
                ['attribute' => 'created_at', 'format' => ['date', 'php:d.m.Y H:i:s']],
                ['attribute' => 'updated_at', 'format' => ['date', 'php:d.m.Y H:i:s']],
            ],
        ]) ?>
    </div>

</div>
