<?php

namespace app\models;

use app\models\EventCustomer;


use yii\helpers\Json;

use yii\behaviors\TimestampBehavior;
use Yii;

/**
 * This is the model class for table "Event".
 *
 * @property int $id
 * @property string $title
 * @property int $teacher_id
 * @property int $program_id
 * @property int $start
 * @property int $end
 * @property int $all_day
 * @property int $created_at
 * @property int $updated_at
 */
class Event extends \yii\db\ActiveRecord
{
     /**
     * @var string
     */
    public $customers = false;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Event';
    }

     /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['teacher_id', 'program_id', 'start', 'end', 'all_day', 'created_at', 'updated_at'], 'integer'],
            // [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Name'),
            'teacher_id' => Yii::t('app', 'Teacher ID'),
            'program_id' => Yii::t('app', 'Program ID'),
            'start' => Yii::t('app', 'Start'),
            'end' => Yii::t('app', 'End'),
            'all_day' => Yii::t('app', 'All Day'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * 
     * {@inheritdoc}
     */
    public function upload($event) 
    {
        $this->title = $event['title'];
        $this->start = intVal($event['start']) / 1000;
        $this->end = intVal($event['end']) / 1000;
        $this->all_day = $event['all_day'] == 'true' ? 1 : 0;
        $this->program_id = intVal($event['program_id']);
        $this->teacher_id = intVal($event['teacher_id']);
        return true;
    }

    /**
     * Save EventCustomer after save model if customers is array
     * @param boolean - $insert
     * @param array - $changedAttributes
     * @return void
     */
    public function afterSave($insert, $changedAttributes)
    {
        if ($this->id && $this->customers) {
            $EventCustomer = new EventCustomer();
            foreach ($this->customers as $customer) {
                $arr[] = [$this->id, $customer['customer_id']];
            }
            $this->saveRelatedData( $arr );
        }
    }

    public function afterDelete()
    {
        $this->deleteRelatedData($this->id);
    }

    /**
    * Deletes a several strings from EventCustomer model.
    * @param array $ids
    * @return count deleted records
    */
    private function deleteRelatedData($ids) 
    {
        return Yii::$app->db->createCommand()->delete(EventCustomer::tableName(), ['event_id' => $ids], $params = [])->execute();
    }

    /**
     * @param array [[event_id, customer_id], ...]
     * @return count added string
     */
    public function saveRelatedData($arr) 
    {
        return Yii::$app->db->createCommand()->batchInsert('event_customer', ['event_id', 'customer_id'], $arr)->execute(); 
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {  
       return $this->hasMany(EventCustomer::className(), ['event_id' => 'id']);
    }

     /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacher() 
    {
        return $this->hasOne(Profile::className(), ['id' => 'teacher_id']);
    }
}
