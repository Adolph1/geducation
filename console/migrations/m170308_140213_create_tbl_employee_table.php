<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_employee`.
 */
class m170308_140213_create_tbl_employee_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_employee', [
            'id' => $this->primaryKey(),
            'first_name'=>$this->string(200)->notNull(),
            'middle_name'=>$this->string(200),
            'last_name'=>$this->string(200)->notNull(),
            'date_of_birth'=>$this->date()->notNull(),
            'job_title'=>$this->string(200)->notNull(),
            'branch_id'=>$this->integer()->notNull(),
            'department_id'=>$this->integer()->notNull(),
            'maker_id'=>$this->string(200),
            'maker_time'=>$this->dateTime(),
        ]);

        // creates index for column `branch_id`
        $this->createIndex(
            'idx-tbl_employee-branch_id',
            'tbl_employee',
            'branch_id'
        );


        // add foreign key for table `tbl_branch`
        $this->addForeignKey(
            'fk-tbl_employee-branch_id',
            'tbl_employee',
            'branch_id',
            'tbl_branch',
            'id',
            'RESTRICT'
        );


        // creates index for column `department_id`
        $this->createIndex(
            'idx-tbl_employee-department_id',
            'tbl_employee',
            'department_id'
        );


        // add foreign key for table `tbl_department`
        $this->addForeignKey(
            'fk-tbl_employee-department_id',
            'tbl_employee',
            'department_id',
            'tbl_department',
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
            'fk-tbl_employee-branch_id',
            'tbl_employee'
        );

        // drops index for column `branch_id`
        $this->dropIndex(
            'idx-tbl_employee-branch_id',
            'tbl_employee'
        );

        $this->dropForeignKey(
            'fk-tbl_employee-department_id',
            'tbl_employee'
        );

        // drops index for column `department_id`
        $this->dropIndex(
            'idx-tbl_employee-department_id',
            'tbl_employee'
        );
        $this->dropTable('tbl_employee');
    }
}
