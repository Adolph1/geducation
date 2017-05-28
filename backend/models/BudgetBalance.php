<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_budget_balance".
 *
 * @property integer $id
 * @property integer $branch_id
 * @property string $balance
 * @property string $last_updated
 * @property string $maker_id
 *
 * @property TblBranch $branch
 */
class BudgetBalance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_budget_balance';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['branch_id'], 'integer'],
            [['balance'], 'number'],
            [['last_updated'], 'safe'],
            [['maker_id'], 'string', 'max' => 200],
            [['branch_id'], 'unique'],
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
            'branch_id' => Yii::t('app', 'Branch ID'),
            'balance' => Yii::t('app', 'Balance'),
            'last_updated' => Yii::t('app', 'Last Updated'),
            'maker_id' => Yii::t('app', 'Maker ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['id' => 'branch_id']);
    }
    public static function getBalance($id)
    {
        if (($model = BudgetBalance::find()->where(['branch_id'=>$id])->one()) !== null) {
            return $model;
        } else {
            return "";
        }
    }
}
