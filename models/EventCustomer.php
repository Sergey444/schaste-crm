<?php

namespace app\models;

use app\models\Customer;

use Yii;

/**
 * This is the model class for table "event_customer".
 *
 * @property int $id
 * @property int $event_id
 * @property int $customer_id
 */
class EventCustomer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'event_customer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['event_id', 'customer_id', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'event_id' => Yii::t('app', 'Event ID'),
            'customer_id' => Yii::t('app', 'Customer ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer() 
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

     /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvent() 
    {
        return $this->hasOne(Event::className(), ['id' => 'event_id']);
    }
}
