<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\DhSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Domens and hostings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dh-index">

    <?php Pjax::begin(); ?>

    <div class="bg-white mg-bottom">
        <div class="row">
            <div class="col-md-8"> 
                <?= Html::tag('button', Yii::t('app', 'Create record'), [
                                                'class' => 'btn btn-success visible-md visible-lg', 
                                                'data-toggle' => 'modal', 
                                                'data-target' => '#createRecord']) ?>
            </div>
            <div class="col-md-4"> <?php echo $this->render('_search', ['model' => $searchModel]); ?> </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <?= Html::a( Yii::t('app', 'Create record'), ['create'], [
                                                'class' => 'btn btn-success visible-xs visible-sm']) ?>
            </div>
        </div>
    </div>

    <div class="bg-white">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                    'attribute' => 'name',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return Html::a($model->name, $model->name ,['target'=>'_blank', 'data-pjax'=>"0"] );
                    }
                ],
                [
                    'attribute' => 'Хостинг',
                    'format' => 'raw',
                    'value' => function ($model) {
                        $host = $model->host ? $model->host : '<span class="not-set">(не задано)</span>';
                        $port = $model->port ? $model->port : '<span class="not-set">(не задано)</span>';
                        return '<div><i class="fa fa-server" aria-hidden="true"></i> '. $host .'</div>
                                <div><i class="fa fa-plug" aria-hidden="true"></i> '. $port .'</div>';
                    }
                ],
                [
                    'attribute' => 'FTP / SFTP',
                    'format' => 'raw',
                    'value' => function($model) {
                        $login = $model->login_ftp ? $model->login_ftp : '<span class="not-set">(не задано)</span>';
                        $passw = $model->password_ftp ? $model->password_ftp : '<span class="not-set">(не задано)</span>';
                        return '<div><i class="fa fa-user" aria-hidden="true"></i> '. $login . '</div>
                                <div><i class="fa fa-unlock" aria-hidden="true"></i> '. $passw .'</div>';
                    }
                ],
                [
                    'attribute' => 'Админ панель',
                    'format' => 'raw',
                    'value' => function($model) {
                        $login = $model->login_panel ? $model->login_panel : '<span class="not-set">(не задано)</span>';
                        $passw = $model->password_panel ? $model->password_panel : '<span class="not-set">(не задано)</span>';
                        return '<div><i class="fa fa-user" aria-hidden="true"></i> ' . $login . '</div>
                                <div><i class="fa fa-unlock" aria-hidden="true"></i> ' . $passw . '</div>';
                    }
                ],
                'comment',
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>

    <?php Pjax::end(); ?>

</div>


<!-- Modal -->
<div class="modal fade" id="createRecord" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content ">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><?=Yii::t('app', 'Create record')?></h4>
        </div>
        <div class="modal-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>

  </div>
</div>