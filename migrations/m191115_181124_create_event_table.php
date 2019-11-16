<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%event}}`.
 */
class m191115_181124_create_event_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%event}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'teacher_id' => $this->integer(),
            'program_id' => $this->integer(),

            'start' => $this->integer(),
            'end' => $this->integer(),
            'all_day' => $this->boolean(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%event}}');
    }
}
