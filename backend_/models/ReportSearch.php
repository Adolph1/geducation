<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Report;

/**
 * ReportSearch represents the model behind the search form about `backend\models\Report`.
 */
class ReportSearch extends Report
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'module', 'status'], 'integer'],
            [['report_name', 'path'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }



    public function search($brnch,$from,$to)
    {
            if($brnch==null) {

                $query = Expenditure::find();

                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                ]);
                $query->andWhere(['status' => 'A']);
                $query->andFilterWhere(['between', 'exp_dt', $from, $to]);
                return $dataProvider;
            }
            else{

                $query = Expenditure::find();

                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                ]);
                $query->andWhere(['status' => 'A','branch_id'=>$brnch]);
                $query->andFilterWhere(['between', 'exp_dt', $from, $to]);
                return $dataProvider;
            }


    }

}
