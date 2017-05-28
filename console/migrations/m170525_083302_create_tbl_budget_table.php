<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_budget`.
 */
class m170525_083302_create_tbl_budget_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_budget', [
            'id' => $this->primaryKey(),
            'trn_dt'=>$this->date(),
            'amount'=>$this->decimal()->notNull(),
            'branch_id'=>$this->integer()->notNull(),
            'maker_id'=>$this->string(),
            'maker_time'=>$this->dateTime(),
        ]);

        // creates index for column `branch_id`
        $this->createIndex(
            'idx-tbl_budget-branch_id',
            'tbl_budget',
            'branch_id'
        );


        // add foreign key for table `tbl_branch`
        $this->addForeignKey(
            'fk-tbl_budget-branch_id',
            'tbl_budget',
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
            'fk-tbl_budget-branch_id',
            'tbl_budget'
        );

        // drops index for column `branch_id`
        $this->dropIndex(
            'idx-tbl_budget-branch_id',
            'tbl_budget'
        );
        $this->dropTable('tbl_budget');
    }
}
