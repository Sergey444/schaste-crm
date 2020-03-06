<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "payment_out".
 *
 * @property int $id
 * @property string $name
 * @property int $sum
 * @property string $type_of_pay
 * @property int $date_of_payment
 * @property int $salary
 * @property string $comment
 * @property int $created_at
 * @property int $updated_at
 */
class PaymentOut extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payment_out';
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
            [['name','sum'], 'required'],
            [['sum', 'salary', 'profile_id', 'created_at', 'updated_at'], 'integer'],
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
            'type_of_pay' => Yii::t('app', 'Type Of Pay'),
            'date_of_payment' => Yii::t('app', 'Date Of Payment'),
            'comment' => Yii::t('app', 'Comment'),
            'profile_id' => Yii::t('app', 'User'),
            'salary' => Yii::t('app', 'Salary'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile() 
    {
        return $this->hasOne(Profile::className(), ['id' => 'profile_id']);
    }
}
