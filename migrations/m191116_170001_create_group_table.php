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
            'name' => $this->string()->notNull(),
            'teacher_id' => $this->integer()->notNull(),
            'program_id' => $this->integer()->notNull(),
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
