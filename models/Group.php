<?php

namespace app\models;

use app\models\Profile;
use app\models\Program;
use app\models\GroupCustomer;

use yii\behaviors\TimestampBehavior;
use Yii;

/**
 * This is the model class for table "group".
 *
 * @property int $id
 * @property string $name
 * @property int $teacher_id
 * @property int $program_id
 * @property string $comment
 * @property int $created_at
 * @property int $updated_at
 */
class Group extends \yii\db\ActiveRecord
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
        return 'group';
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
            [['teacher_id', 'program_id', 'created_at', 'updated_at'], 'integer'],
            [['comment'], 'string'],
            [['name', 'teacher_id', 'program_id'], 'required'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Group name'),
            'teacher_id' => Yii::t('app', 'Teacher'),
            'program_id' => Yii::t('app', 'Program'),
            'comment' => Yii::t('app', 'Comment'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function afterDelete()
    {
        $this->deleteRelatedData($this->id);
    }

    /**
    * Deletes a several strings from GroupCustomer model.
    * @param array $id
    * @return count deleted records
    */
    private function deleteRelatedData($id)
    {
        return Yii::$app->db->createCommand()->delete(GroupCustomer::tableName(), ['group_id' => $id], $params = [])->execute();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacher() 
    {
        return $this->hasOne(Profile::className(), ['id' => 'teacher_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgram() 
    {
        return $this->hasOne(Program::className(), ['id' => 'program_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
       return $this->hasMany(GroupCustomer::className(), ['group_id' => 'id']);
    }
}
