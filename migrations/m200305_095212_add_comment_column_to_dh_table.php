<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%dh}}`.
 */
class m200305_095212_add_comment_column_to_dh_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%dh}}', 'comment', $this->text()->after('password_panel'));
        $this->addColumn('{{%dh}}', 'is_bitrix', $this->boolean()->after('comment'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%dh}}', 'comment');
        $this->dropColumn('{{%dh}}', 'is_bitrix');
    }
}
