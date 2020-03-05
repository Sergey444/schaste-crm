<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%dh}}`.
 */
class m200305_074516_create_dh_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%dh}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'host' => $this->string(),
            'port' => $this->integer(),
            'login_ftp' => $this->string(),
            'password_ftp' => $this->string(),
            'login_panel' => $this->string(),
            'password_panel' => $this->string(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%dh}}');
    }
}
