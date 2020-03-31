<?php

namespace app\controllers;

use Yii;

use app\models\Sticker;

use yii\rest\Controller;

use yii\filters\Cors;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use yii\web\NotFoundHttpException;





use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use app\models\Event;
use app\models\EventCustomer;
use app\models\Program;
use app\models\Customer;
use app\models\Group;
use app\models\Profile;
use app\models\MessageFromSite;


class ApiController extends Controller
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['corsFilter'] = [
            'class' => Cors::className(),
            'cors' => [
                'Origin' => ['https://schaste-club.ru', 'http://schaste-club.ru'],
                'Access-Control-Allow-Credentials' => true,
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
                'update-sticker' => ['PUT'],

                'delete-event' => ['DELETE'],

                'save-message' => ['POST'],
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
                [
                    'actions' => ['save-message'],
                    'allow' => true,
                ]
            ]
        ];

        return $behaviors;
    }


    /**
     * Search customers
     * @return object
     */
    public function actionGetCustomers()
    {
        $customerName = Yii::$app->request->post('customer_name');
        if (isset($customerName)) {
            $result = htmlspecialchars( $customerName ) == '' ? 'Не найдено' : $customerName;
            return Customer::find()->filterWhere(['like', 'child_name', $result])->limit(50)->all();
        }
    }

    /**
     * Save message from site schaste-club.ru
     * @return boolean
     */
    public function actionSaveMessage()
    {
        $model = new MessageFromSite();
        if ($model->load(Yii::$app->request->post(), '') && $model->save()) {
            $this->sendEmail(Yii::$app->request->post());
            return true;
        }
        return false;
    }

    /**
     * STICKERS API
     */
    public function actionGetStickers()
    {
        return Sticker::find()->where(['author_id' => Yii::$app->user->id])->all();
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



    /**
     * JOURNAL API
     */

    /**
     * Get Events for view to journal
     * @return json
     */
    public function actionGetEvents()
    {
        $start = strtotime(Yii::$app->request->get('start'));
        $end = strtotime(Yii::$app->request->get('end'));
        $events = Event::find()->where(['and', ['>', 'start', $start],['<', 'end', $end]])->joinWith(['customers.customer', 'teacher'])->asArray()->all() ;

        foreach ($events as $key => $event) {
            $events[$key]['allDay'] = $event['all_day'] === '1';
            $events[$key]['start'] = $event['start'] * 1000;
            $events[$key]['end'] = $event['end'] * 1000;
            $events[$key]['backgroundColor'] = $event['teacher']['color'] ?: '#3788d8';
        }

        return $events;
    }

    /**
     * Get groups
     * @return json
     */
    public function actionGetGroups()
    {
        return Group::find()->joinWith('customers.customer')->asArray()->all();
    }

    /**
     * Get teachers
     * @return json
     */
    public function actionGetTeachers()
    {
        // 'profile.id' => $model->teacher_id], 
        return Profile::find()->joinWith('position')->where(['position.show_teacher' => 1])->all();
    }

    /**
     * Get programs
     * @return json
     */
    public function actionGetPrograms()
    {
        return Program::find()->all();
    }

     /**
     * Save and delete EventCustomer record
     * @return array
     */
    public function actionSaveClass()
    {
        $result = array();
        $class = Json::decode(Yii::$app->request->post('obj'));

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

        $model = Event::findOne($class['event_id']);
        if ($class['event_id'] && $class['addCustomers']) {
            foreach($class['addCustomers'] as $customer) {
                $arr[] = [$class['event_id'], $customer['customer_id']];
            }
            if ($count = $model->saveRelatedData( $arr )) {
                $result['add'] = 'Добавлено ' . $count;
            }
        }

        return Event::find()->where(['id' => $model->id])->with(['customers.customer', 'teacher'])->asArray()->one();
    }

    /**
     * @return array
     */
    public function actionSetTeacher()
    {
        $event = Yii::$app->request->post();

        $model = Event::findOne($event['id']);
        $model->teacher_id = $event['teacher_id'];
        if ($model->update(false)) {
            return Event::find()->where(['id' => $model->id])->with(['customers.customer', 'teacher'])->asArray()->one();
        }
    }

    /**
     * @return json
     */
    public function actionSetProgram()
    {
        $event = Yii::$app->request->post();

        $model = Event::findOne($event['id']);
        $model->title = $event['title'];
        $model->program_id = $event['program_id'];
        if ($model->update(false)) {
            return Event::find()->where(['id' => $model->id])->with(['customers.customer', 'teacher'])->one();
        }
    }

    /**
     * Create or Update Event model if request has id
     * @return json|integer
     */
    public function actionSetEvent()
    {
        $event = Yii::$app->request->post();
        if (intVal($event['id']) > 0 ) {
            $model = Event::findOne($event['id']);
        } else {
            $model = new Event();
            if ($event['customers']) {
                $model->customers = Json::decode($event['customers']);
            }
        }
        if ($model->upload( $event ) && $model->save()) {
            return Event::find()->where(['id' => $model->id])->with(['customers.customer', 'teacher'])->one();
        }
    }

    /**
     * Delete event
     * @return boolean
     */
    public function actionDeleteEvent($id)
    {
        return Event::findOne($id)->delete();
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

    /**
     * Отправка email config/web.php
     * @param integer $lastId
     * @return count added string
     */
    protected function sendEmail($request)
    {
        return true;
        
        $phone = $request['phone'] ? $request['phone'] : 'не указан';
        $email = $request['email'] ? $request['email'] : 'не указан';
        $message = $request['message'] ? $request['message'] : 'не заполнено';
        $html = 'Форма: '. $request['title'] .'<br>'.
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