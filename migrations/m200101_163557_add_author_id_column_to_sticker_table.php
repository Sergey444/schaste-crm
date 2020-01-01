<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%sticker}}`.
 */
class m200101_163557_add_author_id_column_to_sticker_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%sticker}}', 'author_id', $this->integer()->after('ready'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%sticker}}', 'author_id');
    }
}
