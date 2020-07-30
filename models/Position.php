<?php

namespace app\models;

use app\models\PositionProgram;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "position".
 *
 * @property int $id
 * @property string $name
 * @property int $show_teacher
 * @property int $created_at
 * @property int $updated_at
 */
class Position extends \yii\db\ActiveRecord
{

    public $selected_programs;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'position';
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
            [['name'], 'unique'],
            [['name'], 'string', 'max' => 255],
            [['show_teacher','selected_programs'], 'safe'],
            [['created_at', 'updated_at', ], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Title'),
            'show_teacher' => Yii::t('app', 'Show in list'),
            'selected_programs' => Yii::t('app', 'Programs'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }


    /**
     * Save PositionProgram model
     */
    public function afterSave($insert, $changedAttributes)
    {
        if (is_array($this->selected_programs)) {
            foreach ($this->selected_programs as $program_id) {
                $array[] = [$this->id, $program_id];
            }
            $this->saveRelatedData($this->id, $array);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function afterDelete()
    {
        $this->deleteRelatedData($this->id);
    }

    /**
     * 
     */
    private function saveRelatedData($id, $array)
    {
        return Yii::$app->db->createCommand()->batchInsert(PositionProgram::tableName(), ['position_id', 'program_id'], $array)->execute();
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
    public function getPrograms()
    {
       return $this->hasMany(PositionProgram::className(), ['position_id' => 'id']);
    }

    /**
     * @return array
     */
    public function getProgramList()
    {
        return ArrayHelper::map(Program::find()->all(), 'id', 'name');
    }

    public function getProgramsHtml()
    {
        if (is_array($this->programs)) {
            foreach ($this->programs as $program) {
                $result .= '<div><a href="/program/view/'.$program->program->id.'">'.$program->program->name.'</a></div>';
            }
            return $result;
        }
    }

}
