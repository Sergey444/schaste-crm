<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%sticker}}`.
 */
class m191208_123728_create_sticker_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%sticker}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'description' => $this->text(),
            'color' => $this->string(),
            'left' => $this->integer(),
            'top' => $this->integer(),
            'sort' => $this->integer(),
            'wide' => $this->boolean(),
            'ready' => $this->boolean(),
            
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%sticker}}');
    }
}
