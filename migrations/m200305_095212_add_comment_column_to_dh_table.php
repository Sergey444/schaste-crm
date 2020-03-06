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
        $this->addColumn('{{%dh}}', 'cms_id', $this->integer()->after('comment'));
        $this->addColumn('{{%dh}}', 'host_name', $this->string()->after('cms_id'));
        $this->addColumn('{{%dh}}', 'host_login', $this->string()->after('host_name'));
        $this->addColumn('{{%dh}}', 'host_password', $this->string()->after('host_login'));
        $this->addColumn('{{%dh}}', 'db_name', $this->string()->after('host_password'));
        $this->addColumn('{{%dh}}', 'db_login', $this->string()->after('db_name'));
        $this->addColumn('{{%dh}}', 'db_password', $this->string()->after('db_login'));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%dh}}', 'comment');
        $this->dropColumn('{{%dh}}', 'cms_id');
        $this->dropColumn('{{%dh}}', 'host_name');
        $this->dropColumn('{{%dh}}', 'host_login');
        $this->dropColumn('{{%dh}}', 'host_password');
        $this->dropColumn('{{%dh}}', 'db_name');
        $this->dropColumn('{{%dh}}', 'db_login');
        $this->dropColumn('{{%dh}}', 'db_password');
    }
}
