<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%customer}}`.
 */
class m210829_081133_add_some_columns_to_customer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%customer}}', 'neurologist_conclusion', $this->string()->after('comment'));
        $this->addColumn('{{%customer}}', 'psychiatrist_conclusion', $this->string()->after('neurologist_conclusion'));
        $this->addColumn('{{%customer}}', 'audiologist_conclusion', $this->string()->after('psychiatrist_conclusion'));
        $this->addColumn('{{%customer}}', 'psychologist_conclusion', $this->string()->after('audiologist_conclusion'));
        $this->addColumn('{{%customer}}', 'pmpk_recommendation', $this->string()->after('psychologist_conclusion'));
        $this->addColumn('{{%customer}}', 'date_initial_examination', $this->integer()->after('pmpk_recommendation'));
        $this->addColumn('{{%customer}}', 'initial_examination', $this->string()->after('psychologist_conclusion'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%customer}}', 'neurologist_conclusion');
        $this->dropColumn('{{%customer}}', 'psychiatrist_conclusion');
        $this->dropColumn('{{%customer}}', 'audiologist_conclusion');
        $this->dropColumn('{{%customer}}', 'psychologist_conclusion');
        $this->dropColumn('{{%customer}}', 'pmpk_recommendation');
        $this->dropColumn('{{%customer}}', 'date_initial_examination');
        $this->dropColumn('{{%customer}}', 'initial_examination');
    }
}
