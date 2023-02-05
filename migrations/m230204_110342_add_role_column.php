<?php

use yii\db\Migration;

/**
 * Class m230204_110342_add_role_column
 */
class m230204_110342_add_role_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'role', $this->tinyInteger());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'role');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230204_110342_add_role_column cannot be reverted.\n";

        return false;
    }
    */
}
