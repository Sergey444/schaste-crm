<?php
namespace app\models;

use Yii;
use yii\base\Model;

use app\models\User;

/**
 * UpdateUserForm form
 */
class UpdateUserForm extends Model
{

    public $id;
    public $username;
    public $email;
    public $password;
    public $password_repeat;
    public $status;

    public $user;

     /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'string', 'min' => 6],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],

            ['status', 'integer'],
        ];
    }


     /**
     * Set current values to User
     * 
     * @param integer $id
     */
    function __construct($id = false)
    {
        if (!$id) { return false; }

        $this->user = User::findOne($id);
        $this->username = $this->user->username;
        $this->email = $this->user->email;
        $this->status = $this->user->status;
        // $this->availability = $this->user->availability;
        // $this->company_id =$this->user->company_id;
        
    }

    /**
     * Update user data
     * 
     * @return boolean
     */
    public function update($user) 
    {
        // $this->user->username = $this->username;
        $this->user->email = $this->email;

        if ($this->password) {
            $this->user->setPassword($this->password);
        }
        
        // if (Yii::$app->user->can('admin')) {
        //     $this->user->status = $this->status;
        //     $this->user->availability = $this->availability ? strtotime($this->availability) : null;
        // }

        return $this->user->save();
    }


}