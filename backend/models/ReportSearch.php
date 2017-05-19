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

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    /*public function search($params)
    {
        $query = Report::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'module' => $this->module,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'report_name', $this->report_name])
            ->andFilterWhere(['like', 'path', $this->path]);

        return $dataProvider;
    }*/

    public function search($brnch,$from,$to)
    {


            $query = Expenditure::find();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
            //$query->select(['prchs_dt,price,product_id,sum(qty) AS qty,sum(total) AS total,(select supplier_id from tbl_purchase_invoice where id=purchase_invoice_id) as purchase_invoice_id']);
            $query->andWhere(['status'=>'U','branch_id'=>$brnch]);
            $query->andFilterWhere(['between', 'exp_dt', $from, $to]);
            //$query->groupBy(['prchs_dt','product_id',]);
            return $dataProvider;

    }
}
