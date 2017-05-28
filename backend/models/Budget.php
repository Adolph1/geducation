<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_budget".
 *
 * @property integer $id
 * @property string $amount
 * @property integer $branch_id
 * @property string $maker_id
 * @property string $maker_time
 *
 * @property TblBranch $branch
 */
class Budget extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_budget';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['amount', 'branch_id'], 'required'],
            [['amount'], 'number'],
            [['branch_id'], 'integer'],
            [['maker_time','trn_dt'], 'safe'],
            [['maker_id'], 'string', 'max' => 255],
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
            'trn_dt'=>Yii::t('app', 'Date'),
            'amount' => Yii::t('app', 'Amount'),
            'branch_id' => Yii::t('app', 'Branch'),
            'maker_id' => Yii::t('app', 'Maker ID'),
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
