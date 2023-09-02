<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%homework}}`.
 */
class m230531_143021_create_homework_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%homework}}', [
            'id' => $this->primaryKey(),
            'is_ready' => $this->boolean(),
            'description' => $this->text(),
            'customer_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%homework}}');
    }
}
