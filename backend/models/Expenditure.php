<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_expenditure".
 *
 * @property integer $id
 * @property string $exp_dt
 * @property string $amount
 * @property string $description
 * @property integer $branch_id
 * @property string $maker_id
 * @property string $maker_time
 *
 * @property TblBranch $branch
 */
class Expenditure extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
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
            [['exp_dt', 'amount', 'description'], 'required'],
            [['exp_dt', 'maker_time'], 'safe'],
            [['amount'], 'number'],
            [['branch_id'], 'integer'],
            [['description', 'maker_id'], 'string', 'max' => 200],
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
            'description' => Yii::t('app', 'Description'),
            'branch_id' => Yii::t('app', 'Branch'),
            'maker_id' => Yii::t('app', 'Maker'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['id' => 'branch_id']);
    }
}
