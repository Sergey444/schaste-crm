<?php

namespace app\controllers;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use Yii;

class JournalController extends \yii\web\Controller
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
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'get-customers' => ['POST']
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

}
