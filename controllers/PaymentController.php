<?php

namespace app\controllers;

use Yii;

use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use app\models\PaymentIn;
use app\models\PaymentOut;

use app\models\PaymentInSearch;
use app\models\PaymentOutSearch;

use yii\web\NotFoundHttpException;

class PaymentController extends Controller
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
                ],
            ],
        ];
    }


    /**
     * Lists all PaymentIn and PaymentOut models.
     * @return mixed
     */
    public function actionIndex()
    {
        $modelPaymentIn = new PaymentIn();
        $modelPaymentOut = new PaymentOut();

        $searchModelPaymentIn = new PaymentInSearch();
        $dataProviderPaymentIn = $searchModelPaymentIn->search(Yii::$app->request->queryParams);
        
        $searchModelPaymentOut = new PaymentOutSearch();
        $dataProviderPaymentOut = $searchModelPaymentOut->search(Yii::$app->request->queryParams);

        if ($modelPaymentIn->load(Yii::$app->request->post())) {
            if ($modelPaymentIn->save()) {
                Yii::$app->session->setFlash('success', 'PaymentIn created successfully');
                return $this->redirect(['index']);
            }
        }

        if ($modelPaymentOut->load(Yii::$app->request->post())) {
            if ($modelPaymentOut->save()) {
                Yii::$app->session->setFlash('success', 'PaymentOut created successfully');
                return $this->redirect(['index']);
            }
        }

        return $this->render('index.twig', [
            'modelPaymentIn' => $modelPaymentIn,
            'modelPaymentOut' => $modelPaymentOut,
            'searchModelPaymentIn' => $searchModelPaymentIn,
            'dataProviderPaymentIn' => $dataProviderPaymentIn,
            'searchModelPaymentOut' => $searchModelPaymentOut,
            'dataProviderPaymentOut' => $dataProviderPaymentOut,
        ]);
    }

    /**
     * 
     * @return mixed
     */
    public function actionCreateIn()
    {
        $model = new PaymentIn();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'PaymentIn created successfully');
                return $this->redirect(['index']);
            }
        }

        return $this->render('create-in.twig', [
            'model' => $model,
        ]);
    }

    /**
     * 
     * @return mixed
     */
    public function actionCreateOut()
    {
        $model = new PaymentOut();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'PaymentOut created successfully');
                return $this->redirect(['index']);
            }
        }

        return $this->render('create-out.twig', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PaymentIn model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdateIn($id)
    {
        if (!$model = PaymentIn::findOne($id)){
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update-in.twig', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PaymentOut model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdateOut($id)
    {
        if (!$model = PaymentOut::findOne($id)) {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }

        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update-out.twig', [
            'model' => $model,
        ]);
    }
    
    /**
     * Deletes an existing PaymentIn model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeleteIn($id)
    {
        PaymentIn::findOne($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing PaymentOut model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeleteOut($id)
    {
        PaymentOut::findOne($id)->delete();
        return $this->redirect(['index']);
    }

    

}
