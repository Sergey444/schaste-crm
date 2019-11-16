<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title =  Yii::t('app', 'Personals');
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="personal-index">

    <?php Pjax::begin(); ?>
    
    <!-- <div class="bg-white mg-bottom">
        <div class="row">
            <div class="col-md-8"> <?//= Html::a(Yii::t('app', 'Create Personal'), ['create'], ['class' => 'btn btn-success']) ?> </div>
            <div class="col-md-4"> <?//php echo $this->render('_search', ['model' => $searchModel]); ?> </div>
        </div>
    </div> -->

    <div class="bg-white mg-bottom">
        <div class="row">
            <div class="col-md-8"> 
                <?= Html::tag('button', Yii::t('app', 'Create Personal'), [
                                                'class' => 'btn btn-success visible-md visible-lg', 
                                                'data-toggle' => 'modal', 
                                                'data-target' => '#createUser']) ?>
            </div>
            <div class="col-md-4"> <?php echo $this->render('_search', ['model' => $searchModel]); ?> </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <?= Html::a( Yii::t('app', 'Create Personal'), ['create'], [
                                                'class' => 'btn btn-success visible-xs visible-sm']) ?>
            </div>
        </div>
    </div>


   
    <div class="bg-white">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'surname',
                'name',
                'secondname',
                [
                    'attribute'=>'username',
                    'value' => function ($data) { 
                                return $data->user->username;
                            }
                ],
                ['attribute' => 'date_of_birthday', 'format' => ['date', 'php:d.m.Y']],
                'phone',
                [
                    'attribute'=>'teacher',
                    'format'=>'raw',
                    'value' => function ($data) { 
                                $check = $data->teacher ? 'checked' : '';
                                return '<input type="checkbox" '.$check.' value="'.$data->id.'">';
                            }
                ],
                ['attribute' => 'created_at', 'format' => ['date', 'php:d.m.Y H:i:s']],
                ['attribute' => 'updated_at', 'format' => ['date', 'php:d.m.Y H:i:s']],

                ['class' => 'yii\grid\ActionColumn',
                    'buttons' => [
                        'update' => function($model, $key, $index) {
                            return Html::a(
                                '<span class="glyphicon glyphicon-pencil"></span>',
                                ['update-user', 'id' => $index],
                                ['data-pjax' => 0]
                            );
                        }
                    ]
                ],
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>

</div>

<!-- Modal -->
<div class="modal fade" id="createUser" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><?=Yii::t('app', 'Create Personal')?></h4>
        </div>
        <div class="modal-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>

  </div>
</div>
