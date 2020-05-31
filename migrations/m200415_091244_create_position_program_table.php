<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%position_program}}`.
 */
class m200415_091244_create_position_program_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%position_program}}', [
            'id' => $this->primaryKey(),
            'position_id' => $this->integer()->notNull(),
            'program_id' => $this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%position_program}}');
    }
}
