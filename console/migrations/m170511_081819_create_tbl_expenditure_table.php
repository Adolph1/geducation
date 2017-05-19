<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_expenditure`.
 */
class m170511_081819_create_tbl_expenditure_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_expenditure', [
            'id' => $this->primaryKey(),
            'exp_dt'=>$this->date()->notNull(),
            'amount'=>$this->decimal()->notNull(),
            'description'=>$this->string(200)->notNull(),
            'branch_id'=>$this->integer()->notNull(),
            'maker_id'=>$this->string(200),
            'maker_time'=>$this->dateTime(),
        ]);

        // creates index for column `branch_id`
        $this->createIndex(
            'idx-tbl_expenditure-branch_id',
            'tbl_expenditure',
            'branch_id'
        );


        // add foreign key for table `tbl_branch`
        $this->addForeignKey(
            'fk-tbl_expenditure-branch_id',
            'tbl_expenditure',
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
            'fk-tbl_expenditure-branch_id',
            'tbl_expenditure'
        );

        // drops index for column `supplier_id`
        $this->dropIndex(
            'idx-tbl_expenditure-branch_id',
            'tbl_employee'
        );
        $this->dropTable('tbl_expenditure');
    }
}
