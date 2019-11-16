<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%event_customer}}`.
 */
class m191116_073815_create_event_customer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%event_customer}}', [
            'id' => $this->primaryKey(),
            'event_id' => $this->integer(),
            'customer_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%event_customer}}');
    }
}
