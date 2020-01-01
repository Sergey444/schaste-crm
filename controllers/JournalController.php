<?php

namespace app\controllers;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use yii\helpers\ArrayHelper;
use yii\helpers\Json;

use app\models\Event;
use app\models\EventCustomer;
use app\models\Program;
use app\models\Customer;
use app\models\Group;
use app\models\Profile;

use app\models\Sticker;

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
                    'get-customers' => ['POST'],
                    'save-class' => ['POST'],

                    'set-event' => ['POST'],
                    'set-teacher' => ['POST'],
                    'set-program' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Journal page use fullcalendar on ReactJs
     * @see https://fullcalendar.io/
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

     /**
     * Finds the Customer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Event the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    private function findModel($id)
    {
        if (($model = Event::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
