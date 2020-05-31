<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

use app\models\Position;
use app\models\PositionSearch;


class SettingController extends \yii\web\Controller
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
                    'delete' => ['POST'],
                    'get-customers' => ['POST']
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $position = new Position();
        $positionModel = new PositionSearch();
        $positionProvider = $positionModel->search(Yii::$app->request->queryParams);

        if ($position->load(Yii::$app->request->post())) {
            if ($position->save()) {
                Yii::$app->session->setFlash('success', 'Position created successfully');
                return $this->redirect(['index']);
            }
        }

        return $this->render('index', [
            'position' => $position,
            'positionProvider' => $positionProvider
        ]);
    }

    /**
     * @return string
     */
    public function actionUpdatePosition($id)
    {
        $model = $this->findPositionModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update-position', [
            'model' => $model,
        ]);
    }


    /**
     * Deletes an existing Position model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDeletePosition($id)
    {
        $this->findPositionModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * 
     */
    private function findPositionModel($id)
    {
        if (($model = Position::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
