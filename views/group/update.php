<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Group */

$this->title = Yii::t('app', 'Update Group: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');

$this->registerJsFile('@web/js/order-form.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

?>

<div class="group-update">

    <?php Pjax::begin(); ?>

    <div class="row">
        <div class="col-md-8">
            <div class="bg-white mg-bottom">
                <h3>Страница редактирования группы</h3><hr />
                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
            </div>

            <div class="bg-white mg-bottom">

                <?= Html::beginForm([
                    'group/add-child',
                    'id' => $model->id,
                    ], 'post',
                    ['data-pjax' => 1]); ?>

                    <div class="row">
                        <div class="col-sm-8">
                            <div class="rs-order__customer">
                                <div class="form-group field-order-customer_name">
                                <?= 
                                    Html::label(Yii::t('app', 'Child name'), 'customer_name'), 
                                    Html::input('text', 'customer_name', '', [
                                        'id' => 'order-customer_name', 
                                        'class' => 'form-control', 
                                        'placeholder' => Yii::t('app', 'Start typing a name...')
                                    ]);
                                ?>

                                <div class="help-block"></div>

                                <?= Html::input('hidden', 'GroupCustomer[customer_id]', '', [
                                        'id' => 'order-customer_id' 
                                ])?>

                                <?= Html::input('hidden', 'GroupCustomer[group_id]', $model->id, []) ?>

                                <table class="table table-hover rs-add-to-order">
                                    <tbody id="rs-find-block" class="rs-find-block"></tbody>
                                </table>
                                
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <?= Html::submitButton(Yii::t('app', 'Add to group'), ['class' => 'btn btn-primary d-block mg-top-25']) ?>
                        </div>
                    </div>

                <?= Html::endForm(); ?>

            </div>

        </div>

        <div class="col-md-4">
            <div class="bg-white">
                <!-- <h3>Список учеников</h3><hr/> -->
                <table class="table table-striped table-bordered">
                    <caption><?= Yii::t('app', 'Student list') ?></caption>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><?= Yii::t('app', 'Child name') ?></th>
                            <th></th>
                        </tr>
                            
                    </thead>
                    <tbody>
                    <?if ($model->customers):?>
                        <?foreach ($model->customers as $key => $customer):?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td>
                                    <?= Html::a( $customer->customer->child_name,
                                    ['customer/view', 'id' => $customer->customer->id] 

                                    ) ?>
                                </td>
                                <td>
                                    <?= Html::a(
                                        '<span class="glyphicon glyphicon-trash"></span>', 
                                        [
                                            'group/delete-child', 
                                            'id' => $customer->id, 
                                            'group_id' => $model->id
                                        ], 
                                        [
                                            'class' => '',
                                            'data' => [
                                                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?')]
                                        ]
                                    )?>
                                </a>
                                </td>
                            </tr>
                        <?endforeach?>
                        <?else:?>
                            <tr><td colspan="3"><?= Yii::t('app', 'Nothing found') ?></td></tr>
                        <?endif?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <?php Pjax::end(); ?>

</div>