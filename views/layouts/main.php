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
        'innerContainerOptions' => ['class' => 'container-fluid'],
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
            [
                'label' => '<i class="fas fa-child"></i> ' . Yii::t('app', 'Club customers'), 
                'url' => ['/customer/index'], 'visible' => !Yii::$app->user->isGuest,
                'options' => ['class'=>'visible-xs']
            ],

            ['label' => '<i class="far fa-address-card"></i> ' . Yii::t('app', 'Profile'), 'url' => ['/profile/index'], 'visible' => !Yii::$app->user->isGuest],
            ['label' => '<i class="fas fa-users-cog"></i> ' . Yii::t('app', 'Personals'), 'url' => ['/profile/users'], 'visible' => Yii::$app->user->can('admin')],

            Yii::$app->user->isGuest ? (
                ['label' => Yii::t('app', 'Login'), 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    '<i class="fas fa-door-open"></i> (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>
    
    <div class="" style="padding-top: 70px; ">
        <div class="container-fluid rs-content">
            <div class="rs-left-menu">
                <?
                     echo Nav::widget([
                        'options' => ['class' => 'rs-navbar-left'],
                        'encodeLabels' => false,
                        'items' => [
                            
                            ['label' => '<i class="fas fa-briefcase"></i> <span>' . Yii::t('app', 'Orders') . '</span>', 'url' => ['/order/index'], 'visible' => !Yii::$app->user->isGuest],
                            ['label' => '<i class="fas fa-ruble-sign"></i> <span>' . Yii::t('app', 'Payments') . '</span>', 'url' => ['/payment/index'], 'visible' => !Yii::$app->user->isGuest],
                            ['label' => '<i class="fas fa-calendar-alt"></i> <span>' . Yii::t('app', 'Journal') . '</span>', 'url' => ['/journal/index'], 'visible' => !Yii::$app->user->isGuest],
                            ['label' => '<i class="fas fa-child"></i> <span>' . Yii::t('app', 'Club customers') . '</span>', 'url' => ['/customer/index'], 'visible' => !Yii::$app->user->isGuest],
                            ['label' => '<i class="fas fa-book"></i> <span>' . Yii::t('app', 'Club programs') . '</span>', 'url' => ['/program/index'], 'visible' => !Yii::$app->user->isGuest],
                            ['label' => '<i class="fas fa-layer-group"></i> <span>' . Yii::t('app', 'Groups') . '</span>', 'url' => ['/group/index'], 'visible' => !Yii::$app->user->isGuest],
                            
                            [
                                'label' => '<i class="fas fa-globe-europe"></i> <span>' . Yii::t('app', 'Web site') . '</span>', 
                                'url' => 'https://schaste-club.ru', 
                                'visible' => !Yii::$app->user->isGuest, 
                                'options'=>['class'=>'link-bottom link-bottom--site'],
                                'linkOptions' => ['target' => '_blank']
                            ],
                            [
                                'label' => '<i class="fab fa-wikipedia-w"></i> <span>' . Yii::t('app', 'Documents') . '</span>', 
                                'url' => 'https://wiki.schaste-club.ru', 
                                'visible' => !Yii::$app->user->isGuest, 
                                'options'=>['class'=>'link-bottom'],
                                'linkOptions' => ['target' => '_blank']
                            ],
                            
                        ],
                    ]);
                ?>
            </div>

            <div class="" style="flex-grow: 1;">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>
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
