<?php

namespace app\controllers;

// use scotthuangzl\googlechart\GoogleChart;

use yii\filters\AccessControl;

class AnalyticController extends \yii\web\Controller
{

     /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        return $this->render('index.twig');
    }

}
