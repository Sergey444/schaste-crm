<?php

namespace app\controllers;

use Yii;

use app\models\User;

use app\models\Profile;
use app\models\ProfileSearch;
// use backend\models\Company;
use app\models\SignupForm;
use app\models\UpdateUserForm;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;


/**
 * ProfileController implements the CRUD actions for Profile model.
 */
class ProfileController extends Controller
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
                        'roles' => ['admin'],
                    ],
                    [
                        'actions' => ['update'],
                        'allow' => true,
                        'roles' => ['@'],
                        // 'matchCallback' => function () {
                        //     return $this->findModel(Yii::$app->request->get('id'))->user_id === Yii::$app->user->id;
                        // }
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
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
     * Lists all Profile models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = Profile::find()->where(['user_id' => Yii::$app->user->id])->one();
        
        return $this->render('index', [
            'model' => $model
        ]);
    }

   /**
     * Lists all Profile models.
     * @return mixed
     */
    public function actionUsers() 
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'User created successfully');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $searchModel = new ProfileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('users', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Profile model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('index', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Profile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {   
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'User created successfully');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    
    /**
     * Updates an existing Profile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdateUser($id)
    {
        $model = $this->findModel($id);
        $user = new UpdateUserForm($model->user_id);
        //$company = Company::findOne($user->company_id);

        if ($this->update($id, $model, $user, $company)) {
            Yii::$app->session->setFlash('success', 'User updated successfully');
            return $this->redirect(['update-user', 'id' => $model->id]);
        };
        
        return $this->render('update', [
            'model' => $model,
            'user' => $user,
            'company' => $company
        ]);
    }

    /**
     * Updates an existing Profile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate()
    {
        $id = Yii::$app->user->id;
        $model = Profile::find()->where(['user_id' => $id])->one();
        $user = new UpdateUserForm($id);
        //$company = Company::findOne($user->company_id);

        if ($this->update($id, $model, $user, $company)) {
            Yii::$app->session->setFlash('success', 'User updated successfully');
            return $this->redirect(['update']);
        };
        
        return $this->render('update', [
            'model' => $model,
            'user' => $user,
            'company' => $company
        ]);
    }

   /**
     * Update one from models
     * If updation is successful, the browser will be redirected to the 'update' page.
     * 
     * @param Object - $model
     * @param Object - $user
     * @return Boolean
     */
    private function update($id, $model, $user, $company)
    {
        if ($model->load(Yii::$app->request->post())) {
            $photo = UploadedFile::getInstance($model, 'img');
            if ($photo ) {
                $model->upload($photo);
            }
            if ( $model->save() ) {
                return true;
                // Yii::$app->session->setFlash('success', 'Profile updated successfully');
                // return $this->redirect(['update']);
            }
        }

        if ($user->load(Yii::$app->request->post()) && $user->update($id)) {
            return true;
            // Yii::$app->session->setFlash('success', 'User updated successfully');
            // return $this->redirect(['update']);
        }

        // if ($company->load(Yii::$app->request->post()) && $company->save()) {
        //     return true;
        // }

        return false;
    }

    /**
     * Deletes an existing Profile model.
     * If deletion is successful, the browser will be redirected to the 'users' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $Profile = $this->findModel($id);
        if (($user = User::findOne($Profile->user_id)) !== null) {
            if ( ($company = Company::findOne($user->company_id)) !== null) {
                $company->delete();
            }
            file_exists( $Profile->photo) && unlink( $Profile->photo);
            $Profile->delete();
            $user->delete();
        }
        return $this->redirect(['users']);
    }

    /**
     * Finds the Profile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Profile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Profile::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

