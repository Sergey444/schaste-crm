<?php

namespace app\models;

use app\models\Position;
use app\models\Program;

use Yii;

/**
 * This is the model class for table "position_program".
 *
 * @property int $id
 * @property int $position_id
 * @property int $program_id
 */
class PositionProgram extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'position_program';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['position_id', 'program_id'], 'required'],
            [['position_id', 'program_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'position_id' => Yii::t('app', 'Position ID'),
            'program_id' => Yii::t('app', 'Program ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosition() 
    {
        return $this->hasOne(Position::className(), ['id' => 'position_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgram() 
    {
        return $this->hasOne(Program::className(), ['id' => 'program_id']);
    }
}
