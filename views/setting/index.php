<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use app\models\Position;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Personal */

$this->title =  Yii::t('app', 'Settings');
$this->params['breadcrumbs'][] = Yii::t('app', 'Settings');

// $this->registerJsFile('@web/js/personal.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$arPositions = ArrayHelper::toArray($positionProvider->getModels(), ['id','name','show_teacher']);

?>
<div class="setting">
    <div class="">

    <?php Pjax::begin(); ?>

        <div class="row">
            <div class="col-md-6">
                <div class="bg-white mg-bottom">
                    <h4>Список должностей</h4>

                    <?= GridView::widget([
                        'dataProvider' => $positionProvider,
                        'columns' => [
                            // ['class' => 'yii\grid\SerialColumn'],
                            [
                                'attribute'=>'name',
                                'label' => Yii::t('app', 'Title'),
                            ],
                            [
                                'attribute' => 'show_teacher',
                                'label' => Yii::t('app', 'Show in list'),
                                'format' => 'raw',
                                'value' => function ($data) {
                                    $checked = $data->show_teacher ? 'checked' : '';
                                    return '<div class="material-switch">
                                                <input id="'.$data->id.'" name="show-teacher" type="checkbox" '.$checked.'/>
                                                <label for="'.$data->id.'" class="label-primary"></label>
                                            </div>';
                                }
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{update} {delete}',
                                'buttons' => [
                                    
                                    'update' =>function ($url, $model) {
                                     
                                        return Html::a(
                                            '<span class="glyphicon glyphicon-pencil"></span>', 
                                            ['update-in', 'id' => $model->id],
                                            [
                                                'title' => Yii::t('app', 'Update'),
                                                'data-pjax' => 0
                                            ]
                                        );
                                    },
            
                                    'delete' => function ($url, $model) {
                                        
                                        return Html::a(
                                            '<span class="glyphicon glyphicon-trash"></span>', 
                                            ['delete-position', 'id' => $model->id],
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

                </div>
            </div>
            <div class="col-md-6">
                <div class="bg-white">
                    <?= $this->render('_position', [
                        'model' => $position,
                    ]) ?>
                </div>
            </div>
        </div>

    <?php Pjax::end(); ?>

    </div>
</div>