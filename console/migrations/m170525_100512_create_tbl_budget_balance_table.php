<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_budget_balance`.
 */
class m170525_100512_create_tbl_budget_balance_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_budget_balance', [
            'id' => $this->primaryKey(),
            'branch_id'=>$this->integer()->unique(),
            'balance'=>$this->decimal(),
            'last_updated'=>$this->dateTime(),
            'maker_id'=>$this->string(200),
        ]);
        // creates index for column `branch_id`
        $this->createIndex(
            'idx-tbl_budget_balance-branch_id',
            'tbl_budget_balance',
            'branch_id'
        );


        // add foreign key for table `tbl_branch`
        $this->addForeignKey(
            'fk-tbl_budget_balance-branch_id',
            'tbl_budget_balance',
            'branch_id',
            'tbl_branch',
            'id',
            'RESTRICT'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey(
            'fk-tbl_budget_balance-branch_id',
            'tbl_budget_balance'
        );

        // drops index for column `budget_id`
        $this->dropIndex(
            'idx-tbl_budget_balance-branch_id',
            'tbl_budget_balance'
        );
        $this->dropTable('tbl_budget_balance');
    }
}
