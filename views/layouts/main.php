<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,
        'items' => [
            ['label' => '<i class="fas fa-child"></i> ' . Yii::t('app', 'Club customers') , 'url' => ['/customer/index'], 'visible' => !Yii::$app->user->isGuest],
            ['label' => '<i class="far fa-address-card"></i> ' . Yii::t('app', 'Profile'), 'url' => ['/profile/index'], 'visible' => !Yii::$app->user->isGuest],
            ['label' => '<i class="fas fa-users-cog"></i> ' . Yii::t('app', 'Personals'), 'url' => ['/profile/users'], 'visible' => Yii::$app->user->can('admin')],
            // ['label' => '<i class="fas fa-address-card"></i> ' .Yii::t('app', 'NAV_SUBSCRIPTIONS'), 'url' => ['/subscriptions/index'], 'linkOptions' => ['class' => 'rs-menu__link']],
            // ['label' => '<i class="fas fa-users"></i> ' . Yii::t('app', 'NAV_GROUPS'), 'url' => ['/groups/index'], 'linkOptions' => ['class' => 'rs-menu__link']],
            // ['label' => '<i class="fas fa-user-graduate"></i> ' . Yii::t('app', 'TEACHERS') , 'url' => ['/teachers/index'], 'linkOptions' => ['class' => 'rs-menu__link']],
            // ['label' => '<i class="fas fa-book"></i> ' . Yii::t('app', 'NAV_REGISTR') , 'url' => ['/journal/index'], 'linkOptions' => ['class' => 'rs-menu__link']],
            // ['label' =>  '<i class="fas fa-tasks"></i> ' . Yii::t('app', 'NAV_PROGRAMS') , 'url' => ['/programs/index'], 'linkOptions' => ['class' => 'rs-menu__link']],
            // ['label' =>  '<i class="fas fa-tasks"></i> ' . Yii::t('app', 'NAV_MESSAGE') , 'url' => ['/message-from-site/index'], 'linkOptions' => ['class' => 'rs-menu__link']],
            // ['label' => '<i class="far fa-address-card"></i> ' . Yii::t('app', 'HOME') , 'url' => ['/user/index'], 'linkOptions' => ['class' => 'rs-menu__link']],
            Yii::$app->user->isGuest ? (
                ['label' => Yii::t('app', 'Login'), 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    Yii::t('app', 'Logout') .' (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
