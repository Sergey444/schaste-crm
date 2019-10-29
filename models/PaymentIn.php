<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

use app\models\Order;

/**
 * This is the model class for table "payment_in".
 *
 * @property int $id
 * @property string $name
 * @property int $sum
 * @property int $customer_id
 * @property string $type_of_pay
 * @property int $date_of_payment
 * @property int $order_id
 * @property string $comment
 * @property int $created_at
 * @property int $updated_at
 */
class PaymentIn extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payment_in';
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
            [['name', 'sum'], 'required'],
            [['sum', 'order_id', 'customer_id', 'created_at', 'updated_at'], 'integer'],
            [['comment'], 'string'],
            [['name', 'type_of_pay'], 'string', 'max' => 255],
            [['date_of_payment'], 'string'],
            [['date_of_payment'], 'datetime', 'format' => 'php:d.m.Y', 'timestampAttribute' => 'date_of_payment'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name Of Pay'),
            'sum' => Yii::t('app', 'Sum'),
            'customer_id' => Yii::t('app', 'Customer'),
            'type_of_pay' => Yii::t('app', 'Type Of Pay'),
            'date_of_payment' => Yii::t('app', 'Date Of Payment'),
            'order_id' => Yii::t('app', 'Order ID'),
            'comment' => Yii::t('app', 'Comments'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

     /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder() 
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }

}
