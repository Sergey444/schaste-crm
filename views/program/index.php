<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProgramSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Programs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="program-index">

   
    <?php Pjax::begin(); ?>

    <div class="bg-white mg-bottom">
        <div class="row">
            <div class="col-md-8"> 
                <?= Html::tag('button', Yii::t('app', 'Create Program'), [
                                                'class' => 'btn btn-success visible-md visible-lg', 
                                                'data-toggle' => 'modal', 
                                                'data-target' => '#createProgram']) ?>
            </div>
            <div class="col-md-4"> <?php echo $this->render('_search', ['model' => $searchModel]); ?> </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <?= Html::a( Yii::t('app', 'Create contact'), ['create'], [
                                                'class' => 'btn btn-success visible-xs visible-sm']) ?>
            </div>
        </div>
    </div>

    <div class="bg-white">

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'name',
                'one_price',
                'comment:ntext',
                ['attribute' => 'created_at', 'format' => ['date', 'php:d.m.Y H:i:s']],
                //'updated_at',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>

    </div>

    <?php Pjax::end(); ?>

</div>

<!-- Modal -->
<div class="modal fade" id="createProgram" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><?=Yii::t('app', 'Create Program')?></h4>
        </div>
        <div class="modal-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>

  </div>
</div>