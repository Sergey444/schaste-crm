<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%event_customer}}`.
 */
class m191130_114238_add_comment_visit_scip_column_to_event_customer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%event_customer}}', 'comment', $this->text());
        $this->addColumn('{{%event_customer}}', 'visit', $this->boolean());
        $this->addColumn('{{%event_customer}}', 'scip', $this->boolean());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%event_customer}}', 'comment');
        $this->dropColumn('{{%event_customer}}', 'visit');
        $this->dropColumn('{{%event_customer}}', 'scip');
    }
}
