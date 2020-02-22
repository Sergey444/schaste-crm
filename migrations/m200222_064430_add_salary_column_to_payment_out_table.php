<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%payment_out}}`.
 */
class m200222_064430_add_salary_column_to_payment_out_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%payment_out}}', 'salary', $this->boolean()->after('comment'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%payment_out}}', 'salary');
    }
}
