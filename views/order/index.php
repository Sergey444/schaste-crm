<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\widgets\ListView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\Orderearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Orders');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">


    <!-- <p>
        <?//= Html::a(Yii::t('app', 'Create Order'), ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="bg-white mg-bottom">
        <div class="row">
            <div class="col-md-8"> 
                <?= Html::tag('button', Yii::t('app', 'Create Order'), [
                                                'class' => 'btn btn-success visible-md visible-lg', 
                                                'data-toggle' => 'modal', 
                                                'data-target' => '#createOrder']) ?>
            </div>
            <div class="col-md-4"> <?php echo $this->render('_search', ['model' => $searchModel]); ?> </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <?= Html::a( Yii::t('app', 'Create Order'), ['create'], [
                                                'class' => 'btn btn-success visible-xs visible-sm']) ?>
            </div>
        </div>
    </div>

<?if (!$_GET['table']):?>
    <div class="" style="">
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_list',
            'viewParams' => [
                'fullView' => true,
                'context' => 'main-page',
            ],
            'summary' => '<br><div class="summary row">
                            <div class="col-xs-8">Показаны записи <b>{begin}</b>-<b>{end}</b> из <b>{totalCount}</b></div>
                            <div class="col-xs-4 t-right">
                                <span class="bg-white">
                                    <span class="glyphicon glyphicon-th"></span>
                                    <a class="glyphicon glyphicon-th-list" href="?table=1" ></a>
                                </span>
                            </div>
                        </div>',
            'summaryOptions' => [
                'class' => 'mg-bottom',
            ],

            'itemOptions' => [
                'class' => 'order-item mg-bottom col-md-4'
            ],

            'beforeItem' => function ($model, $key, $index, $widget) use ($columns) {
                if ( $index === 0 ) {
                    return '<div class="row">';
                }
                if ( $index % 3 == 0 ) {
                    return "</div><div class='row'>";
                }
            },
            'layout' => '{summary}
                            {items}
                       </div>{pager}',
        ]);?>
    </div>
<?else:?>
    <div class="bg-white">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            // 'filterModel' => $searchModel,
            'summary' => '<div class="summary row">
                            <div class="col-xs-8">Показаны записи <b>{begin}</b>-<b>{end}</b> из <b>{totalCount}</b></div>
                            <div class="col-xs-4 t-right">
                                <a class="glyphicon glyphicon-th" href="?block" ></a>
                                <span class="glyphicon glyphicon-th-list"></span>
                            </div>
                        </div>',
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'name',
                'customer.child_name',
                'unit_price',
                'sum',
                'count',
                'status',
                ['attribute' => 'date_start', 'format' => ['date', 'php:d.m.Y']],
                ['attribute' => 'date_end', 'format' => ['date', 'php:d.m.Y']],
                //'service_id',
                //'payment_id',
                //'company_id',
                //'created_at',
                //'updated_at',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
<?endif?>
    <?php Pjax::end(); ?>

</div>


<!-- Modal -->
<div class="modal fade" id="createOrder" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content ">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><?=Yii::t('app', 'Create Order')?></h4>
        </div>
        <div class="modal-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>

  </div>
</div>