<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_expenditure_type`.
 */
class m170519_082825_create_tbl_expenditure_type_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_expenditure_type', [
            'id' => $this->primaryKey(),
            'type'=>$this->string(200)->notNull(),
            'department_id'=>$this->integer(),
            'maker_id'=>$this->string(200),
            'maker_time'=>$this->dateTime(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_expenditure_type');
    }
}
