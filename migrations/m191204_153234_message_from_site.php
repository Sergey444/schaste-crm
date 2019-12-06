<?php

use yii\db\Migration;

/**
 * Class m191204_153234_message_from_site
 */
class m191204_153234_message_from_site extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%message_from_site}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'phone' => $this->string(),
            'email' => $this->string(),
            'message' => $this->text(),
            'page' => $this->string(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%message_from_site}}');
    }
}
