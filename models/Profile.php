<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use app\models\User;

use yii\helpers\FileHelper;
use yii\imagine\Image;
// use Imagine\Image\Box;
/**
 * This is the model class for table "Profile".
 *
 * @property int $id
 * @property int $user_id
 * @property string $surname
 * @property string $name
 * @property string $secondname
 * @property int $date_of_birthday
 * @property int $phone
 * @property int $created_at
 * @property int $updated_at
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * @var
     */
    public $img;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile';
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
            [['phone'], 'safe'],
            [['teacher'], 'default', 'value'=> 1],
            [['color'], 'default', 'value'=> '#fe17bf'],
            [['user_id', 'created_at', 'updated_at'], 'integer'],
            [['surname', 'name', 'secondname'], 'string', 'max' => 255],
            [['img'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxSize' => 1024 * 1024 * 2],
            [['photo', 'address', 'color'], 'string'],
            [['date_of_birthday'], 'datetime', 'format' => 'php:d.m.Y', 'timestampAttribute' => 'date_of_birthday'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => Yii::t('app', 'Username'),
            'user_id' => Yii::t('app', 'User ID'),
            'surname' => Yii::t('app', 'Surname'),
            'name' => Yii::t('app', 'Name'),
            'secondname' => Yii::t('app', 'Secondname'),
            'date_of_birthday' => Yii::t('app', 'Date of birthday'),
            'photo' => Yii::t('app', 'Photo'),
            'phone' => Yii::t('app', 'Phone'),
            'color' => Yii::t('app', 'Color'),
            'teacher' => Yii::t('app', 'Teacher'),
            'address' => Yii::t('app', 'Address'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Сохраняем файл
     *
     * @param Object file
     * @return String path || false
     */
    public function upload($photo)
    {
        $path = 'uploads/'.date('Y-m');
        $fileName = Yii::$app->security->generateRandomString(8). '.' . $photo->extension; // $photo->baseName .
        $url = $path.'/'.$fileName;

        if (FileHelper::createDirectory($path)) {
            $res = $photo->saveAs($url);
            // Image::thumbnail('uploads/2/avatar.jpg', 120, 120)->save(Yii::getAlias('uploads/destination/thumb-test-image.jpg'), ['quality' => 50]);
            if ($res) {
                file_exists($this->photo) && unlink($this->photo);
                $this->photo = $url;
                return true;
            }
        }
        return false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return string
     */
    public function getFullName() {
        return $this->surname . ' ' . $this->name .' '. $this->secondname;
    }
}
