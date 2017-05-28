<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_expenditure".
 *
 * @property integer $id
 * @property string $exp_dt
 * @property string $amount
 * @property integer $type
 * @property string $description
 * @property integer $branch_id
 * @property integer $department_id
 * @property string $fund_source
 * @property string $payment_method
 * @property string $reference_no
 * @property string $attachment
 * @property string $status
 * @property string $maker_id
 * @property string $maker_time
 * @property string $checker
 * @property string $checker_time
 *
 * @property TblBranch $branch
 */
class Expenditure extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $attachment_file;

    public static function tableName()
    {
        return 'tbl_expenditure';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['exp_dt', 'amount', 'type', 'description', 'branch_id', 'fund_source'], 'required'],
            [['exp_dt', 'maker_time', 'checker_time'], 'safe'],
            [['amount'], 'number'],
            [['type', 'branch_id', 'department_id'], 'integer'],
            [['description', 'reference_no', 'attachment', 'maker_id', 'checker'], 'string', 'max' => 200],
            [['fund_source', 'payment_method', 'status','delete_stat'], 'string', 'max' => 1],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::className(), 'targetAttribute' => ['branch_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'exp_dt' => Yii::t('app', 'Date'),
            'amount' => Yii::t('app', 'Amount'),
            'type' => Yii::t('app', 'Type'),
            'description' => Yii::t('app', 'Description'),
            'branch_id' => Yii::t('app', 'Branch'),
            'department_id' => Yii::t('app', 'Department'),
            'fund_source' => Yii::t('app', 'Fund Source'),
            'payment_method' => Yii::t('app', 'Payment Method'),
            'reference_no' => Yii::t('app', 'Reference No'),
            'attachment' => Yii::t('app', 'Attachment'),
            'status' => Yii::t('app', 'Status'),
            'delete_stat'=>'Delete status',
            'maker_id' => Yii::t('app', 'Maker'),
            'maker_time' => Yii::t('app', 'Maker Time'),
            'checker' => Yii::t('app', 'Checker'),
            'checker_time' => Yii::t('app', 'Checker Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['id' => 'branch_id']);
    }

    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'department_id']);
    }

    public function getExpType()
    {
        return $this->hasOne(ExpenditureType::className(), ['id' => 'type']);
    }
    public function getPayment()
    {
        return $this->hasOne(PaymentMethod::className(), ['id' => 'payment_method']);
    }
}
