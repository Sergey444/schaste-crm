<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

use app\models\Program;
use app\models\Customer;
use app\models\PaymentIn;
use app\models\Profile;

use yii\validators\Validator;
/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $name
 * @property string $bill_number
 * @property int $count
 * @property int $unit_price
 * @property int $sum
 * @property int $status
 * @property int $date_start
 * @property int $date_end
 * @property int $program_id
 * @property int $customer_id
 * @property int $created_at
 * @property int $updated_at
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @var string 
     */
    public $type_customer = 'old';
    /**
     * @var string
     */
    public $customer_new_name;
    /**
     * @var string
     */
    public $parents_new_name;
    /**
     * @var string
     */
    public $customer_name;
    /**
     * @var string
     */
    public $customer_phone;
    /**
     * @var string
     */
    public $checkbox_payment;
    /**
     * @var 
     */
    public $date_payment;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
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
            [['status', 'program_id', 'customer_id', 'teacher_id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'sum'], 'required'],
            [['count', 'unit_price', 'sale','sum'], 'integer', 'min' => 0],
            [['name'], 'string', 'max' => 255],
            [['date_start', 'date_end'], 'string'],
            [['date_start'], 'datetime', 'format' => 'php:d.m.Y', 'timestampAttribute' => 'date_start'],
            [['date_end'], 'datetime', 'format' => 'php:d.m.Y', 'timestampAttribute' => 'date_end'],

            [['customer_new_name', 'parents_new_name', 'customer_phone'], 'string'],
            [['customer_new_name', 'parents_new_name', 'customer_phone'], 'required', 'when' => function($model) {
                return $model->type_customer == 'new';
            }, 'whenClient' => "function (attribute, value) {
                return $('[data-name=type_customer]:checked').val() == 'new';
            }"],

            [['customer_name'], 'required', 'when' => function($model) {
                return $model->type_customer == 'old';
            }, 'whenClient' => "function (attribute, value) {
                return $('[data-name=type_customer]:checked').val() == 'old';
            }"],

            [['date_payment'], 'string'],
            [['date_payment'], 'datetime', 'format' => 'php:d.m.Y', 'timestampAttribute' => 'date_payment'],
            [['date_payment'], 'required', 'when' => function($model) {
                return $model->checkbox_payment == '1';
            }, 'whenClient' => "function (attribute, value) {
                return $('[data-name=payment_create]:checked').val() == '1';
            }"],

            [['type_customer', 'checkbox_payment'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Order Name'),
            'count' => Yii::t('app', 'Count'),
            'unit_price' => Yii::t('app', 'Unit Price'),
            'sum' => Yii::t('app', 'Sum'),
            'sale' => Yii::t('app', 'Sale'),
            'status' => Yii::t('app', 'Status'),
            'date_start' => Yii::t('app', 'Date Start'),
            'date_payment' => Yii::t('app', 'Date Of Payment'),
            'date_end' => Yii::t('app', 'Date End'),
            'program_id' => Yii::t('app', 'Program'),
            'teacher_id' => Yii::t('app', 'Teacher'),
            'customer_new_name' => Yii::t('app', 'Name'),
            'customer_id' => Yii::t('app', 'Customer'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Save customer if type_customer is new
     * @param boolean - $insert 
     * @return boolean
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            if ($this->type_customer === 'new') {
                $customer = new Customer();
                $customer->child_name = $this->customer_new_name;
                $customer->parents_name = $this->parents_new_name;
                $customer->phone = $this->customer_phone;
                if ($customer->save()) {
                    $this->customer_id = $customer->id;
                    $this->customer_name = '';
                }
            }
            return true;
        } 
        return false;
    }

    /**
     * Save paymentIn after save model if checkbox_payment is true
     * @param boolean - $insert
     * @param array - $changedAttributes
     * @return void
     */
    public function afterSave($insert, $changedAttributes)
    {
        if ($this->id && $this->checkbox_payment) {
            $paymentIn = new PaymentIn();
            $paymentIn->name = Yii::t('app', 'Pay for order') .' «'. $this->name .'»';
            $paymentIn->order_id = $this->id;
            $paymentIn->customer_id = $this->customer_id;
            $paymentIn->sum = $this->sum;
            $paymentIn->date_of_payment = date('d.m.Y', $this->date_payment);
            $paymentIn->save();
        }
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
    public function getProgram() 
    {
        return $this->hasOne(Program::className(), ['id' => 'program_id']);
    }

     /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacher() 
    {
        return $this->hasOne(Profile::className(), ['id' => 'teacher_id']);
    }



    /**
     * Return data about order whith link to detail
     * @return string
     */
    public function getFullData() 
    {
        return '<a href="/order/view/'. $this->id .'">'. $this->name .'</a> '.
            $this->sum .'р '. $this->program->name .' <b>'. 
            Yii::$app->formatter->asDate($this->date_start, 'php:d.m.Y') .'</b> - <b>'. Yii::$app->formatter->asDate($this->date_end, 'php:d.m.Y') .'</b>';
    }
}
