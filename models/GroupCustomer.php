<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "group_customer".
 *
 * @property int $id
 * @property int $group_id
 * @property int $customer_id
 */
class GroupCustomer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'group_customer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['group_id', 'customer_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'group_id' => Yii::t('app', 'Group ID'),
            'customer_id' => Yii::t('app', 'Customer ID'),
        ];
    }
}
