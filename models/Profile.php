<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\helpers\FileHelper;
use yii\helpers\ArrayHelper;
use yii\imagine\Image;

use app\models\User;
use app\models\Position;

/**
 * This is the model class for table "Profile".
 * use Imagine\Image\Box;
 *
 * @property int $id
 * @property int $user_id
 * @property string $surname
 * @property string $name
 * @property string $secondname
 * @property string $photo
 * @property int $date_of_birthday
 * @property int $phone
 * @property int $position_id
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
            BlameableBehavior::className()
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['phone'], 'filter', 'filter' => function($value){
                return preg_replace('/[^\d]+/', '', $value);
            }],
            [['color'], 'default', 'value'=> '#fe17bf'],
            [['user_id', 'position_id', 'created_at', 'updated_at'], 'integer'],
            [['surname', 'name', 'secondname'], 'string', 'max' => 255],
            [['img'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, HEVC, HEIF', 'maxSize' => 1024 * 1024 * 2],
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
            'position_id' => Yii::t('app', 'Position'),
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
        $thumbUrl = $path.'/thumb-40/'.$fileName;

        if (FileHelper::createDirectory($path)) {

                $this->deletePhoto();
                $resImage = Image::autorotate($photo->tempName);
            
                $metadata = $resImage->metadata();
                $metadata->offsetSet('ifd0.Orientation', 1);
                $resImage->metadata($metadata);
                Image::resize($resImage, 200, 200, false, false)->save(Yii::getAlias('@webroot/'.$url));
                         
                $this->photo = $url;
                return true;
        }
        return false;
    }

    /**
     * Deletes photo if exists
     * @return boolean
     */
    public function deletePhoto()
    {
        return file_exists($this->photo) && unlink($this->photo);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosition() {
        return $this->hasOne(Position::className(), ['id' => 'position_id']);
    }

    /**
     * @return string
     */
    public function getFullName() {
        return $this->surname . ' ' . $this->name .' '. $this->secondname;
    }

     /**
     * @return string - html
     */
    public function getHtmlStatus() {
        return $this->user->status === 10 ? '<span class="status-circle"></span>' : '<span class="status-circle status-circle--red"></span>'; 
    }

     /**
     * @return string - html
     */
    public function getHtmlColor() {
        return $this->color && $this->position->show_teacher && $this->user->status === 10 ? '<span class="status-square" style="background-color: '.$this->color.'"></span>' : ''; 
    }

    /**
     * @return array
     */
    public function getPositionList()
    {
        return ArrayHelper::map(Position::find()->all(), 'id', 'name');
    }
}
