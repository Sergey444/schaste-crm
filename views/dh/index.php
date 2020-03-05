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
                        // return '<a href="'. $model->name .'" target="_blank" >'. $model->name .'</a>';
                    }
                ],
                [
                    'attribute' => 'FTP / SFTP',
                    'format' => 'html',
                    'value' => function($model) {
                        return '<table class="table table-bordered"><tbody>
                                <tr><td>Имя хоста:</td><td>' . $model->host . '</td></tr>
                                <tr><td>Порт:</td><td>'. $model->port .'</td></tr>
                                <tr><td>Логин:</td><td>'. $model->login_ftp .'</td></tr>
                                <tr><td>Пароль:</td><td>'. $model->password_ftp .'</td></tr>
                                </tbody></table>';
                    }
                ],
                [
                    'attribute' => 'Админ панель',
                    'format' => 'raw',
                    'value' => function($model) {
                        $str = '<table class="table table-bordered"><tbody>
                                <tr><td>Логин:</td><td>' . $model->login_panel . '</td></tr>
                                <tr><td>Пароль:</td><td>' . $model->password_panel . '</td></tr>
                                </tbody></table>';

                        // $str .= $model->is_bitrix ? '<form action="'. $model->name .'/bitrix/admin/?login=yes" method="post">
                        //         <input type="hidden" name="AUTH_FORM" value="Y">
                        //         <input type="hidden" name="TYPE" value="AUTH">
                        //         <input type="text" name="captcha_word" class="login-input" tabindex="5" autocomplete="off">
                        //         <input type="hidden" name="sessid" id="sessid" value="">
                        //         <input type="hidden" name="USER_LOGIN" value="'.$model->login_panel.'">
                        //         <input type="hidden" name="USER_PASSWORD" value="'.$model->password_panel.'">
                        //         <input type="submit" name="Login" value="Авторизоваться"></form>' : '';

                        return $str;

                    }
                ],

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