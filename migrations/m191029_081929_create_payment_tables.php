<?php

use yii\db\Migration;

/**
 * Class m191029_081929_create_payment_tables
 */
class m191029_081929_create_payment_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%payment_in}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'sum' => $this->integer()->notNull(),
            'customer_id' => $this->integer(),
            'type_of_pay' => $this->string(),
            'date_of_payment' => $this->integer(),
            'order_id' => $this->integer(),
            'comment' => $this->text(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull()
        ]);

        $this->createTable('{{%payment_out}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'sum' => $this->integer()->notNull(),
            'type_of_pay' => $this->string(),
            'date_of_payment' => $this->integer(),
            'comment' => $this->text(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%payment_in}}');
        $this->dropTable('{{%payment_out}}');
    }
}
