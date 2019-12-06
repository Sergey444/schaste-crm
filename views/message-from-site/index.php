<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\MessageFromSiteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Message from site');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-from-site-index">

    <?php Pjax::begin(); ?>
    
    <div class="bg-white mg-bottom">
        <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-4"> <?php echo $this->render('_search', ['model' => $searchModel]); ?> </div>
        </div>
    </div>

    <div class="bg-white">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'title',
                'name',
                [
                    'attribute' => 'phone',
                    'format'=>'raw',
                    'value' => function($model) {
                         return '<a href="tel:+'.$model->phone.'">'
                                    .Yii::$app->formatter->asPhone($model->phone).'</a>';
                    },
                ],
                'email:email',
                'message:ntext',
                // 'page',
                ['attribute' => 'created_at', 'format' => ['date', 'php:d.m.Y H:i:s']],
                ['attribute' => 'updated_at', 'format' => ['date', 'php:d.m.Y H:i:s']],

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>

    <?php Pjax::end(); ?>

</div>
