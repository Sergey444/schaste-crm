<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;

use Yii;

/**
 * This is the model class for table "sticker".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $color
 * @property int $left
 * @property int $top
 * @property int $sort
 * @property int $wide
 * @property int $ready
 * @property int $created_at
 * @property int $updated_at
 */
class Sticker extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sticker';
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
            [['description'], 'string'],
            [['left', 'top', 'sort', 'wide', 'ready', 'created_at', 'updated_at'], 'integer'],
            // [['created_at', 'updated_at'], 'required'],
            [['name', 'color'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'color' => Yii::t('app', 'Color'),
            'left' => Yii::t('app', 'Left'),
            'top' => Yii::t('app', 'Top'),
            'sort' => Yii::t('app', 'Sort'),
            'wide' => Yii::t('app', 'Wide'),
            'ready' => Yii::t('app', 'Ready'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Update model
     * @param array
     * @return boolean
     */
    public function upload($sticker)
    {
        $this->name = $sticker['name'];
        $this->left = $sticker['left'];
        $this->top = $sticker['top'];
        $this->description = $sticker['description'];
        $this->wide = $sticker['wide'];
        $this->ready = $sticker['ready'];
        $this->sort = $sticker['sort'];
        $this->color = '#' . $sticker['color'];
        return $this->update(false);
    }

    /**
     * @return object
     */
    public function create()
    {
        $this->name = 'Новая заметка';
        $this->color = '#337ab7';
        $this->sort = Sticker::find()->max('sort');
        $this->left = 0;
        $this->top = 0;
        if ($this->save()) {
            return $this;
        }

    }
}
