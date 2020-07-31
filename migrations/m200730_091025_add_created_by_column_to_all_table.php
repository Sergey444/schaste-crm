<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%all}}`.
 */
class m200730_091025_add_created_by_column_to_all_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%payment_out}}', 'created_by', $this->integer());
        $this->addColumn('{{%payment_in}}', 'created_by', $this->integer());
        $this->addColumn('{{%position}}', 'created_by', $this->integer());
        $this->addColumn('{{%customer}}', 'created_by', $this->integer());
        $this->addColumn('{{%profile}}', 'created_by', $this->integer());
        $this->addColumn('{{%program}}', 'created_by', $this->integer());
        $this->addColumn('{{%sticker}}', 'created_by', $this->integer());
        $this->addColumn('{{%event}}', 'created_by', $this->integer());
        $this->addColumn('{{%group}}', 'created_by', $this->integer());
        $this->addColumn('{{%order}}', 'created_by', $this->integer());
        $this->addColumn('{{%dh}}', 'created_by', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%payment_out}}', 'created_by');
        $this->dropColumn('{{%payment_in}}', 'created_by');
        $this->dropColumn('{{%position}}', 'created_by');
        $this->dropColumn('{{%customer}}', 'created_by');
        $this->dropColumn('{{%profile}}', 'created_by');
        $this->dropColumn('{{%program}}', 'created_by');
        $this->dropColumn('{{%sticker}}', 'created_by');
        $this->dropColumn('{{%event}}', 'created_by');
        $this->dropColumn('{{%group}}', 'created_by');
        $this->dropColumn('{{%order}}', 'created_by');
        $this->dropColumn('{{%dh}}', 'created_by');
    }
}
