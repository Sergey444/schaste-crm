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
            [['port', 'cms_id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'host', 'login_ftp', 'password_ftp', 'login_panel', 'password_panel', 'host_name', 'host_login', 'host_password', 'db_name', 'db_login', 'db_password'], 'string', 'max' => 255],
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
            'host' => Yii::t('app', 'Host'),
            'port' => Yii::t('app', 'Port'),
            'login_ftp' => Yii::t('app', 'Login FTP'),
            'password_ftp' => Yii::t('app', 'Password FTP'),
            'login_panel' => Yii::t('app', 'Login Panel'),
            'password_panel' => Yii::t('app', 'Password Panel'),
            'comment' => Yii::t('app', 'Comment'),
            'cms_id' => Yii::t('app', 'CMS'),
            'host_name' => Yii::t('app', 'Host name'),
            'host_login' => Yii::t('app', 'Host login'),
            'host_password' => Yii::t('app', 'Host password'),
            'db_name' => Yii::t('app', 'Date base name'),
            'db_login' => Yii::t('app', 'Date base login'),
            'db_password' => Yii::t('app', 'Date base password'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
