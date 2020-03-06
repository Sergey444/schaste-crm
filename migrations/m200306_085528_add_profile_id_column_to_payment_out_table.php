<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%payment_out}}`.
 */
class m200306_085528_add_profile_id_column_to_payment_out_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%payment_out}}', 'profile_id', $this->integer()->after('salary'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%payment_out}}', 'profile_id');
    }
}
