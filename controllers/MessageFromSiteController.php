<?php

namespace app\controllers;

use Yii;
use app\models\MessageFromSite;
use app\models\MessageFromSiteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * MessageFromSiteController implements the CRUD actions for MessageFromSite model.
 */
class MessageFromSiteController extends Controller
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
                        'actions' => ['create'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index', 'view', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'create' => ['POST']
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent :: beforeAction($action);
    }

    /**
     * Lists all MessageFromSite models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MessageFromSiteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MessageFromSite model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new MessageFromSite model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        header('Access-Control-Allow-Origin: https://schaste-club.ru');
        $request = Yii::$app->request->post();
        foreach ($request as $key => $value) {
            $request = json_decode($key);
            break;
        }

        
        if ( $request->name && ( $request->phone || $request->email ) ) {
            $this->sendEmail($request);

            $model = new MessageFromSite();
            $model->title = $request->title;
            $model->name = $request->name;
            $model->phone = $request->phone ? $request->phone : null;
            $model->email = $request->email ? $request->email : null;
            $model->message = $request->message ? $request->message : null;
            return $model->save();
        }
        return 'Форма не сохранена';

        // $model = new MessageFromSite();
        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id]);
        // }
        // return $this->render('create', [
        //     'model' => $model,
        // ]);
    }

    /**
     * Updates an existing MessageFromSite model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MessageFromSite model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MessageFromSite model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MessageFromSite the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MessageFromSite::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * Отправка email config/web.php
     * @param integer $lastId
     * @return count added string
     */
    protected function sendEmail($request)
    {
        $phone = $request->phone ? $request->phone : 'не указан';
        $email = $request->email ? $request->email : 'не указан';
        $message = $request->message ? $request->message : 'не заполнено';
        $html = 'Форма: '. $request->title .'<br>'.
                'Телефон: '. $phone .'<br>'.
                'Email: '. $email .'<br>'.
                'Сообщение: '.$message;


        return Yii::$app->mailer->compose()
                ->setFrom(['info@schaste-club.ru' => 'Детский клуб счастье'])
                ->setTo('info@schaste-club.ru')
                ->setSubject('Детский клуб счастье')
                // ->setTextBody('Текст для body')
                ->setHtmlBody($html)
                ->send();
    }
}
