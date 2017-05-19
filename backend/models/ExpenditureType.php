<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "tbl_expenditure_type".
 *
 * @property integer $id
 * @property string $type
 * @property string $maker_id
 * @property string $maker_time
 */
class ExpenditureType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_expenditure_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
            [['maker_time'], 'safe'],
            [['department_id'], 'integer'],
            [['type', 'maker_id'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
            'department_id'=> Yii::t('app', 'Department'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }

    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'department_id']);
    }



    public static function getAll()
    {
        return ArrayHelper::map(ExpenditureType::find()->all(),'id','type');
    }
}
