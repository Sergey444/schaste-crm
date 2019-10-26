<?php

use yii\helpers\StringHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContactsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = Yii::t('app', 'Contacts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contacts-index">

    <?php Pjax::begin(); ?>

    <div class="bg-white mg-bottom">
        <div class="row">
            <div class="col-md-8"> 
                <?= Html::tag('button', Yii::t('app', 'Create contact'), [
                                                'class' => 'btn btn-success visible-md visible-lg', 
                                                'data-toggle' => 'modal', 
                                                'data-target' => '#createContact']) ?>
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
            // ['class' => 'yii\grid\CheckboxColumn'],
            'child_name',
            'parents_name',
            [
                'attribute' => 'phone',
                'format'=>'raw',
                'value' => function($model) {
                     return '<a href="tel:+'.$model->phone.'">'
                                .Yii::$app->formatter->asPhone($model->phone).'</a>';
                },
            ],
            'email:email',
            // 'comment:ntext',
            [
                'attribute' => 'comment',
                'value' => function ($model) {
                    return StringHelper::truncate($model->comment, 100);
                }
            ], 
            ['attribute' => 'birthday', 'format' => ['date', 'php:d.m.Y']],
            ['attribute' => 'created_at', 'format' => ['date', 'php:d.m.Y H:i:s']],
            // ['attribute' => 'updated_at', 'format' => ['date', 'php:d.m.Y H:i:s']],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div>

    <br>
    <?/*= Html::a('Удалить выбранные', ['multi-delete'], [
        'id' => 'btn-multi-del',
        'class' => 'btn btn-default',
        'onclick' => 'setParams()',
        'data' => [
            'confirm' => 'Вы действительно хотите удалить выбранные элементы?',
            'method' => 'post'
        ]
     ]);*/?> 

    <?php Pjax::end(); ?>

</div>


<!-- Modal -->
<div class="modal fade" id="createContact" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><?=Yii::t('app', 'Create contact')?></h4>
        </div>
        <div class="modal-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>

  </div>
</div>