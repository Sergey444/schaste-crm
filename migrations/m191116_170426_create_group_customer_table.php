<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%group_customer}}`.
 */
class m191116_170426_create_group_customer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%group_customer}}', [
            'id' => $this->primaryKey(),
            'group_id' => $this->integer()->notNull(),
            'customer_id' => $this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%group_customer}}');
    }
}
