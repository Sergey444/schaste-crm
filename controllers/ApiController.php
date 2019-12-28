<?php

namespace app\controllers;

use Yii;

use app\models\Sticker;

use yii\rest\Controller;

use yii\filters\Cors;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use yii\web\NotFoundHttpException;

class ApiController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['corsFilter'] = [
            'class' => Cors::className(),
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'DELETE', 'PUT'],
                'Access-Control-Request-Headers'=> ['Content-Type'], //'Origin', 'Accept', 'Authorization'
            ]
        ];
        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'stickers' => ['GET'],
                'delete-sticker' => ['DELETE'],
                'create-sticker' => ['POST'],
                'update-sticker' => ['PUT']
            ],
        ];

        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'rules' => [
                [
                    'actions' => [],
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ]
        ];

        return $behaviors;
    }

    /**
     * STICKERS API
     */
    public function actionGetStickers()
    {
        return Sticker::find()->all();
    }
    public function actionUpdateSticker($id)
    {
        if ($model = Sticker::findOne($id)) {
            return $model->upload(Yii::$app->request->post());
        }
    }
    public function actionCreateSticker()
    {
        $model = new Sticker();
        return $model->create();
    }
    public function actionDeleteSticker($id)
    {
        return Sticker::findOne($id)->delete();
    }


}