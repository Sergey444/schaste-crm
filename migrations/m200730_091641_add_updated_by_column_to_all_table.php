<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%all}}`.
 */
class m200730_091641_add_updated_by_column_to_all_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%payment_out}}', 'updated_by', $this->integer());
        $this->addColumn('{{%payment_in}}', 'updated_by', $this->integer());
        $this->addColumn('{{%position}}', 'updated_by', $this->integer());
        $this->addColumn('{{%customer}}', 'updated_by', $this->integer());
        $this->addColumn('{{%profile}}', 'updated_by', $this->integer());
        $this->addColumn('{{%program}}', 'updated_by', $this->integer());
        $this->addColumn('{{%sticker}}', 'updated_by', $this->integer());
        $this->addColumn('{{%event}}', 'updated_by', $this->integer());
        $this->addColumn('{{%group}}', 'updated_by', $this->integer());
        $this->addColumn('{{%order}}', 'updated_by', $this->integer());
        $this->addColumn('{{%dh}}', 'updated_by', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%payment_out}}', 'updated_by');
        $this->dropColumn('{{%payment_in}}', 'updated_by');
        $this->dropColumn('{{%position}}', 'updated_by');
        $this->dropColumn('{{%customer}}', 'updated_by');
        $this->dropColumn('{{%profile}}', 'updated_by');
        $this->dropColumn('{{%program}}', 'updated_by');
        $this->dropColumn('{{%sticker}}', 'updated_by');
        $this->dropColumn('{{%event}}', 'updated_by');
        $this->dropColumn('{{%group}}', 'updated_by');
        $this->dropColumn('{{%order}}', 'updated_by');
        $this->dropColumn('{{%dh}}', 'updated_by');
    }
}
