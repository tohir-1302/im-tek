<?php

use yii\db\Migration;

/**
 * Class m230204_105359_add_verificationtoken_column
 */
class m230204_105359_add_verificationtoken_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'verification_token', $this->string()->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'verification_token');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230204_105359_add_verificationtoken_column cannot be reverted.\n";

        return false;
    }
    */
}
