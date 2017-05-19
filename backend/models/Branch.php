<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "tbl_branch".
 *
 * @property integer $id
 * @property string $branch_name
 * @property string $location
 *
 * @property TblEmployee[] $tblEmployees
 * @property TblExpenditure[] $tblExpenditures
 */
class Branch extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_branch';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['branch_name', 'location'], 'required'],
            [['branch_name', 'location'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'branch_name' => Yii::t('app', 'Branch Name'),
            'location' => Yii::t('app', 'Location'),
        ];
    }

    //gets all branches

    public static function getAll()
    {
        return ArrayHelper::map(Branch::find()->all(),'id','branch_name');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblEmployees()
    {
        return $this->hasMany(Employee::className(), ['branch_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblExpenditures()
    {
        return $this->hasMany(Expenditure::className(), ['branch_id' => 'id']);
    }
    public static function getBranchName($id)
    {
        $branch=Branch::find()->where(['id'=>$id])->one();
        if($branch!=null){
            return $branch->branch_name;
        }
        else{
            return "";
        }
    }
}
