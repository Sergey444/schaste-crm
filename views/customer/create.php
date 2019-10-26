<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Contacts */

$this->title = Yii::t('app', 'Create contact');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contacts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contacts-create">

    <div class="bg-white">
        <h3>Страница добавления контакта</h3><hr />
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>

</div>
