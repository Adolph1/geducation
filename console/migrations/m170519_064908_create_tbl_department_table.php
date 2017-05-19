<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_department`.
 */
class m170519_064908_create_tbl_department_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_department', [
            'id' => $this->primaryKey(),
            'dept_name'=>$this->string(200)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_department');
    }
}
