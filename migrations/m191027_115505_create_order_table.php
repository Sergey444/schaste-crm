<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order}}`.
 */
class m191027_115505_create_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'count' => $this->integer(),
            'rest_count' => $this->integer(),
            'unit_price' => $this->integer(),
            'sale' => $this->integer(),
            'sum' => $this->integer(),
            'status' => $this->integer(),
            'program_id' => $this->integer(),
            'teacher_id' => $this->integer(),
            'customer_id'=> $this->integer(),
            'date_start' => $this->integer(),
            'date_end' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order}}');
    }
}
