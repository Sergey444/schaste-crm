<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "dh".
 *
 * @property int $id
 * @property string $name
 * @property string $host
 * @property int $port
 * @property string $login_ftp
 * @property string $password_ftp
 * @property string $login_panel
 * @property string $password_panel
 * @property int $created_at
 * @property int $updated_at
 */
class Dh extends \yii\db\ActiveRecord
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
        return 'dh';
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
            [['name'], 'required'],
            [['comment'], 'string'],
            [['port', 'is_bitrix', 'created_at', 'updated_at'], 'integer'],
            [['name', 'host', 'login_ftp', 'password_ftp', 'login_panel', 'password_panel'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Domen name'),
            'host' => Yii::t('app', 'Host name'),
            'port' => Yii::t('app', 'Port'),
            'login_ftp' => Yii::t('app', 'Login FTP'),
            'password_ftp' => Yii::t('app', 'Password FTP'),
            'login_panel' => Yii::t('app', 'Login Panel'),
            'password_panel' => Yii::t('app', 'Password Panel'),
            'comment' => Yii::t('app', 'Comment'),
            'is_bitrix' => Yii::t('app', 'Site on Bitrix'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
