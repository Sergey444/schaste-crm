<?php
/* @var $this yii\web\View */
use yii\helpers\Html;

use yii\grid\GridView;
use yii\widgets\Pjax;
use \yii\widgets\Menu;

$this->title = Yii::t('app', 'Payments');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="payment">
    <div class="bg-white mg-bottom">
        <div class="row" style="margin-bottom: 16px;">

            <?= Menu::widget([
                'options' => ['class' => 'rs-time-nav col-md-8'],
                'linkTemplate' => '<a class="btn btn-default rs-btn__time" href="{url}"><span>{label}</span></a>',
                'items' => [
                    ['label' => Yii::t('app', 'All time'), 'url' => ['/payment/index'], 'active' => !Yii::$app->request->get('time')],
                    ['label' => Yii::t('app', 'Last month'), 'url' => ['/payment/index', 'time' => 'last-month']],
                    ['label' => Yii::t('app', 'Current month'), 'url' => ['/payment/index', 'time' => 'current-month']],
                ],
                'encodeLabels' => false, 
                'activateParents' => true ]); ?>
            <div class="col-md-4" style="text-align: right;">

                <div style="margin-left: 3px; float: right;">
                    <?= Html::tag('button', Yii::t('app', 'Set payment out'), [
                                                        'class' => 'btn btn-danger visible-md visible-lg', 
                                                        'data-toggle' => 'modal', 
                                                        'data-target' => '#createPaymentOut']) ?>
                </div>

                <div  style=" float: right;">
                    <?= Html::tag('button', Yii::t('app', 'Set payment in'), [
                                                        'class' => 'btn btn-success visible-md visible-lg', 
                                                        'data-toggle' => 'modal', 
                                                        'data-target' => '#createPaymentIn']) ?>
                </div>

                <?= Html::a( Yii::t('app', 'Set payment in'), ['payment-in'], ['class' => 'btn btn-success mg-bottom visible-xs visible-sm']) ?>
                <?= Html::a( Yii::t('app', 'Set payment out'), ['payment-out'], ['class' => 'btn btn-danger visible-xs visible-sm']) ?>
            </div>
        </div>
    </div>

    <?php Pjax::begin(); ?>

    <div class="bg-white mg-bottom">
        <span class="payment-description">Поступления</span>
        <?= GridView::widget([
            'dataProvider' => $dataProviderPaymentIn,
            'tableOptions' => [
                'class' => 'table table-bordered table-payment-in'
            ],
            'columns' => [
                // ['class' => 'yii\grid\SerialColumn'],
                ['class' => 'yii\grid\CheckboxColumn'],
                'name',
                'sum',
                'type_of_pay',
                ['attribute' => 'date_of_payment', 'format' => ['date', 'php:d.m.Y']],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'buttons' => [
                        'delete' => function ($url, $model) {
                         
                            return Html::a(
                                '<span class="glyphicon glyphicon-trash"></span>', 
                                ['delete-in', 'id' => $model->id],
                                [
                                    'title' => Yii::t('app', 'Delete'),
                                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                    'data' => [
                                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                        'method' => 'post',
                                    ],
                                    'data-pjax' => 0
                                ]
                            );
                        }
                    ]
                ],
            ],
        ]); ?>

        <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-4" style="text-align: right;">
                <?= Yii::t('app', 'Total') .': '. $searchModelPaymentIn->total ?>
            </div>
        </div>
        
    </div>

    <?php Pjax::end(); ?>
    
    <?php Pjax::begin(); ?>

    <div class="bg-white">
        <span class="payment-description">Расходы</span>
        <?= GridView::widget([
            'dataProvider' => $dataProviderPaymentOut,
            'tableOptions' => [
                'class' => 'table table-bordered table-payment-out'
            ],
            'columns' => [
                // ['class' => 'yii\grid\SerialColumn'],
                ['class' => 'yii\grid\CheckboxColumn'],
                'name',
                'sum',
                'type_of_pay',
                ['attribute' => 'date_of_payment', 'format' => ['date', 'php:d.m.Y']],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'buttons' => [
                        'delete' => function ($url, $model) {
                         
                            return Html::a(
                                '<span class="glyphicon glyphicon-trash"></span>', 
                                ['delete-out', 'id' => $model->id],
                                [
                                    'title' => Yii::t('app', 'Delete'),
                                    'data' => [
                                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                        'method' => 'post',
                                    ],
                                    'data-pjax' => 0,
                                ]
                            );
                        }
                    ]
                ],
            ],
        ]); ?>

        <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-4" style="text-align: right;">
                <?= Yii::t('app', 'Total') .': '. $searchModelPaymentOut->total ?>
            </div>
        </div>
    </div>

    <?php Pjax::end(); ?>

</div>

<!-- Modal -->
<div class="modal fade" id="createPaymentIn" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?=Yii::t('app', 'Set payment in')?></h4>
            </div>
            <div class="modal-body">
                <?= $this->render('_form-in', [
                    'model' => $modelPaymentIn,
                ]) ?>
            </div>
        </div>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="createPaymentOut" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?=Yii::t('app', 'Set payment out')?></h4>
            </div>
            <div class="modal-body">
                <?= $this->render('_form-out', [
                    'model' => $modelPaymentOut,
                ]) ?>
            </div>
        </div>

    </div>
</div>