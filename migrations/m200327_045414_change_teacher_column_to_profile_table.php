<?php

use yii\db\Migration;

/**
 * Class m200327_045414_change_teacher_column_to_profile_table
 */
class m200327_045414_change_teacher_column_to_profile_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('profile', 'teacher', 'position_id');
        $this->alterColumn('profile', 'position_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('profile', 'position_id', 'teacher');
        $this->alterColumn('profile', 'teacher', $this->boolean());
    }
}
