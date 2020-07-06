<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

use yii\helpers\Html;

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
     * @var string
     */
    public $customer_name;
    
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
            [['date_of_payment', 'customer_name'], 'string'],
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
            'comment' => Yii::t('app', 'Comment'),
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer() 
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * @return string html callback
     */
    public function getUpdateCallback()
    {
        return function ($url, $model) {
            return Html::a(
                '<span class="glyphicon glyphicon-pencil"></span>', 
                ['update-in', 'id' => $model->id],
                [
                    'title' => Yii::t('app', 'Update'),
                    'data-pjax' => 0
                ]
                );
        };
    }

    /**
     * @return string html callback
     */
    public function getDeleteCallback()
    {
        return function ($url, $model) {
            return Html::a(
                '<span class="glyphicon glyphicon-trash"></span>', 
                ['delete-in', 'id' => $model->id],
                [
                    'title' => Yii::t('app', 'Delete'),
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                    'data-pjax' => 0
                ]
            );
        };
    }
}
