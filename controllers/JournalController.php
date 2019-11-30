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

use Yii;

class JournalController extends \yii\web\Controller
{

    // /**
    //  * {@inheritdoc}
    //  */
    // public function behaviors()
    // {
    //     return [
    //         'access' => [
    //             'class' => AccessControl::className(),
    //             'rules' => [
    //                 [
    //                     'actions' => [],
    //                     'allow' => true,
    //                     'roles' => ['@'],
    //                 ],
    //             ]
    //         ],
    //         'verbs' => [
    //             'class' => VerbFilter::className(),
    //             'actions' => [
    //                 'get-customers' => ['POST'],
    //                 // 'get-programs' => ['POST']
    //             ],
    //         ],
    //     ];
    // }

    /**
     * 
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Get programs
     * @return array json encode
     */
    public function actionGetPrograms() 
    {
        header('Access-Control-Allow-Origin: *');
        $programs = ArrayHelper::toArray( Program::find()->all() );
        return Json::encode($programs);
    }

    /**
     * Get groups
     * @return array json encode
     */
    public function actionGetGroups() 
    {
        header('Access-Control-Allow-Origin: *');
        //->joinWith('customers.customer')->asArray()
        $groups = ArrayHelper::toArray( Group::find()->joinWith('customers.customer')->asArray()->all() );
        return Json::encode($groups);
    }

    /**
     * Get teachers
     * @return array json encode
     */
    public function actionGetTeachers() 
    {
        header('Access-Control-Allow-Origin: *');
        $teachers = ArrayHelper::toArray( Profile::find()->where(['teacher' => 1])->all() );
        return Json::encode($teachers);
    }

    /**
     * 
     * @return object
     */
    public function actionGetCustomers()
    {
        header('Access-Control-Allow-Origin: *');
        $customerName = Yii::$app->request->get('customer_name');
        // Поиск клиентов для добавления в заказ ajax
        if (isset($customerName)) {
            $result = htmlspecialchars( $customerName ) == '' ? 'Не найдено' : $customerName;
            $customers = Customer::find()->filterWhere(['like', 'child_name', $result])->limit(50)->all();
            return Json::encode(ArrayHelper::toArray($customers)) ;
        }
        return 0;
    }

    /**
     * Get Events for view to journal
     * @return array - jsone encode
     */
    public function actionGetEvents() 
    {
        header('Access-Control-Allow-Origin: *');
        $events = ArrayHelper::toArray( Event::find()->joinWith(['customers.customer', 'teacher'])->asArray()->all() );
        return Json::encode($events);
    }

    /**
     * Save and delete EventCustomer record
     * @return array
     */
    public function actionSaveClass()
    {
        header('Access-Control-Allow-Origin: *');
        $result = array();
        $class = Json::decode(Yii::$app->request->get()['obj']);

        if ($class['delCustomers']) {
            $result['delete'] = $this->deleteEventCustomer($class['delCustomers']);
        }

        if ($class['updCustomers']) {
            $ids = ArrayHelper::getColumn($class['updCustomers'], 'id');
            $models = EventCustomer::find()->where(['id' => $ids])->all();
            foreach($models as $key => $model) {
                $model->comment = $class['updCustomers'][$key]['comment'];
                $model->scip = $class['updCustomers'][$key]['scip'];
                $model->visit = $class['updCustomers'][$key]['visit'];
                $model->update(false);
            }
        }
        
        $model = $this->findModel($class['event_id']);
        if ($class['event_id'] && $class['addCustomers']) {
            foreach($class['addCustomers'] as $customer) {
                $arr[] = [$class['event_id'], $customer['customer_id']];
            }
            if ($count = $model->saveRelatedData( $arr )) {
                $result['add'] = 'Добавлено ' . $count;
            }
        }

        return Json::encode(ArrayHelper::toArray( 
            Event::find()->where(['id' => $model->id])->with(['customers.customer', 'teacher'])->asArray()->one()
        ));
    }

    /**
     * 
     */
    public function actionSetTeacher()
    {
        header('Access-Control-Allow-Origin: *');
        $event = Yii::$app->request->get();

        $model = $this->findModel($event['id']);
        $model->teacher_id = $event['teacher_id'];
        if ($model->update(false)) {
            return Json::encode(ArrayHelper::toArray( 
                Event::find()->where(['id' => $model->id])->with(['customers.customer', 'teacher'])->asArray()->one()
            ));
        }
        return 0;
    }

    /**
     * 
     */
    public function actionSetProgram()
    {
        header('Access-Control-Allow-Origin: *');
        $event = Yii::$app->request->get();

        $model = $this->findModel($event['id']);
        $model->title = $event['title'];
        $model->program_id = $event['program_id'];
        if ($model->update(false)) {
            return Json::encode(ArrayHelper::toArray( 
                Event::find()->where(['id' => $model->id])->with(['customers.customer', 'teacher'])->asArray()->one()
            ));
        }
        return 0;
    }
    
    
    /**
     * Create or Update Event model if request has id
     * @return mixed json|integer 
     */
    public function actionSetEvent()
    {
        header('Access-Control-Allow-Origin: *');
        $event = Yii::$app->request->get();

        if (intVal($event['id']) > 0 ) {
            $model = $this->findModel($event['id']);
        } else {
            $model = new Event();
            if ($event['customers']) {
                $model->customers = Json::decode($event['customers']);
            }
        }
        if ($model->upload( $event ) && $model->save()) {
            return Json::encode(ArrayHelper::toArray( 
                Event::find()->where(['id' => $model->id])->with(['customers.customer', 'teacher'])->asArray()->one()
            ));
            
        }
        return 0;
    }

    /**
     * 
     */
    public function actionDeleteEvent()
    {
        header('Access-Control-Allow-Origin: *');
        $id = Yii::$app->request->get()['id'] ?? false;
        if ($id) {
            return Json::encode($this->findModel($id)->delete());
        }
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

    /**
    * Deletes a several strings from EventCustomer model.
    * @param array $ids
    * @return count deleted strings
    */
    private function deleteEventCustomer($ids) 
    {
        return Yii::$app->db->createCommand()->delete(EventCustomer::tableName(), ['id' => $ids], $params = [])->execute();
    }


    


}
