<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use Yii;

/**
 * This is the model class for table "message_from_site".
 *
 * @property int $id
 * @property string $title
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $message
 * @property string $page
 * @property string $term
 * @property int $created_at
 * @property int $updated_at
 */
class MessageFromSite extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'message_from_site';
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
            [['title', 'name'], 'required'],
            [['message'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['title', 'name', 'phone', 'email', 'page'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'name' => Yii::t('app', 'Name'),
            'phone' => Yii::t('app', 'Phone'),
            'email' => Yii::t('app', 'Email'),
            'message' => Yii::t('app', 'Comment'),
            'page' => Yii::t('app', 'Page'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
