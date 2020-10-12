<?php

namespace app\controllers;

use scotthuangzl\googlechart\GoogleChart;

class AnalyticController extends \yii\web\Controller
{
    public function actionIndex()
    {


        return $this->render('index.twig');
    }

}
