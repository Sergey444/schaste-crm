<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "Customer".
 *
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $city
 * @property string $comments
 * @property string $birthday
 *
 * @property int $created_at
 * @property int $updated_at
 */
class Customer extends \yii\db\ActiveRecord
{

    /**
     * @var
     */
    public $term;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer';
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
            ['email', 'trim'],
            ['email', 'email'],

            [['child_name'], 'unique'],
            [['child_name', 'parents_name', 'phone'], 'required'],
            [['comment'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['birthday'], 'datetime', 'format' => 'php:d.m.Y', 'timestampAttribute' => 'birthday'],
            [['child_name', 'parents_name', 'phone'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'child_name' => Yii::t('app', 'Child name'),
            'parents_name' => Yii::t('app', 'Parent name'),
            'phone' => Yii::t('app', 'Phone'),
            'email' => Yii::t('app', 'Email'),
            'comment' => Yii::t('app', 'Comment'),
            'birthday' => Yii::t('app', 'Date of birthday'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
       return $this->hasMany(Order::className(), ['customer_id' => 'id']);
    }
}
