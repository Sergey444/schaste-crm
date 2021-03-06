<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

use app\models\User;
use app\models\Profile;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $id;
    public $username;
    public $email;
    public $password;
    public $password_repeat;
    public $status;

    public $surname;
    public $name;
    public $secondname;
    public $date_of_birthday;
    public $phone;
    public $user_id;
    // public $teacher;
    public $position_id;

    public $user;



    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // ['username', 'trim'],
            // ['username', 'required'],
            // ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            // ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],

            [['password', 'password_repeat'], 'required'],
            ['password', 'string', 'min' => 6],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],

            ['status', 'integer'],
            ['name', 'required'],

            ['phone', 'safe'],
            [['user_id', 'position_id'], 'integer'],
            [['surname', 'name', 'secondname'], 'string', 'max' => 255],
            [['date_of_birthday'], 'datetime', 'format' => 'php:d.m.Y', 'timestampAttribute' => 'date_of_birthday'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->email;
        $user->email = $this->email;
        $user->status = 9;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $this->sendEmail($user) && $user->save();

        $auth = Yii::$app->authManager;
        $authorRole = $auth->getRole('author');
        $auth->assign($authorRole, $user->getId());

        $personal = new Profile();
        $personal->name = $this->name ? $this->name : null;
        $personal->surname = $this->surname ? $this->surname : null;
        $personal->secondname = $this->secondname ? $this->secondname : null;
        $personal->date_of_birthday = $this->date_of_birthday ? strtotime($this->date_of_birthday) : null;
        $personal->phone = $this->phone ? $this->phone : null;
        $personal->user_id = $user->id;
        $personal->position_id = $this->position_id;
        $personal->save();

        return $this->id = $personal->id;
    }

    /**
     * @return array
     */
    public function getPositionList()
    {
        return ArrayHelper::map(Position::find()->all(), 'id', 'name');
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            // ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->name])
            ->setTo($this->email)
            ->setSubject('Email зарегистрирован в приложении клуба' )
            ->send();
    }
}
