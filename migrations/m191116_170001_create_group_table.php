<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%group}}`.
 */
class m191116_170001_create_group_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%group}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'teacher_id' => $this->integer(),
            'program_id' => $this->integer(),
            'comment' => $this->text(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%group}}');
    }
}
