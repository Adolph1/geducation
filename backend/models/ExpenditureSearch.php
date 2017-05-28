<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Expenditure;

/**
 * ExpenditureSearch represents the model behind the search form about `backend\models\Expenditure`.
 */
class ExpenditureSearch extends Expenditure
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type', 'branch_id', 'department_id'], 'integer'],
            [['exp_dt', 'description', 'fund_source', 'payment_method', 'reference_no', 'attachment', 'status', 'maker_id', 'maker_time', 'checker', 'checker_time'], 'safe'],
            [['amount'], 'number'],
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
    public function search($params)
    {
        $query = Expenditure::find();

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
            'exp_dt' => $this->exp_dt,
            'amount' => $this->amount,
            'type' => $this->type,
            'branch_id' => $this->branch_id,
            'department_id' => $this->department_id,
            'maker_time' => $this->maker_time,
            'checker_time' => $this->checker_time,
            'status'=>'A',

        ]);

        $query->andFilterWhere([ '!=','delete_stat','D']);

        $query->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'fund_source', $this->fund_source])
            ->andFilterWhere(['like', 'payment_method', $this->payment_method])
            ->andFilterWhere(['like', 'reference_no', $this->reference_no])
            ->andFilterWhere(['like', 'attachment', $this->attachment])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'maker_id', $this->maker_id])
            ->andFilterWhere(['like', 'checker', $this->checker]);

        return $dataProvider;
    }
//Accountant search all pending expenditures
    public function searchPending($params)
    {
        $query = Expenditure::find();

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
            'exp_dt' => $this->exp_dt,
            'amount' => $this->amount,
            'type' => $this->type,
            'branch_id' => $this->branch_id,
            'department_id' => $this->department_id,
            'maker_time' => $this->maker_time,
            'checker_time' => $this->checker_time,
            'status'=>'U',

        ]);

        $query->andFilterWhere([ '!=','delete_stat','D']);

        $query->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'fund_source', $this->fund_source])
            ->andFilterWhere(['like', 'payment_method', $this->payment_method])
            ->andFilterWhere(['like', 'reference_no', $this->reference_no])
            ->andFilterWhere(['like', 'attachment', $this->attachment])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'maker_id', $this->maker_id])
            ->andFilterWhere(['like', 'checker', $this->checker]);

        return $dataProvider;
    }

    public function searchByUser($params)
    {
        $query = Expenditure::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // grid filtering conditions
        $query->andFilterWhere([
            'branch_id' => Employee::getBranchID(Yii::$app->user->identity->emp_id),
            'maker_id' => Yii::$app->user->identity->username,
            'status'=>'A',

        ]);
        $query->andFilterWhere([ '!=','delete_stat','D']);

        $query->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'maker_id', $this->maker_id]);

        return $dataProvider;
    }

//Branch Manager search all her/his pending expenditures
    public function searchPendingByUser($params)
    {
        $query = Expenditure::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // grid filtering conditions
        $query->andFilterWhere([
            'branch_id' => Employee::getBranchID(Yii::$app->user->identity->emp_id),
            'maker_id' => Yii::$app->user->identity->username,
            'status'=>'U',

        ]);
        $query->andFilterWhere([ '!=','delete_stat','D']);

        $query->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'maker_id', $this->maker_id]);

        return $dataProvider;
    }

    public function lineChart()
    {
        $query=Expenditure::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $pagination = false;
        $query->select(['maker_id,exp_dt, branch_id,sum(amount) AS amount']);
        $query->andWhere(['!=', 'status', 'U']);
        $query->andFilterWhere(['between', 'exp_dt', date('Y').'-'.date('m').'-'.'01',  date('Y').'-'.date('m').'-'.'31']);
        $query->groupBy(['maker_id']);
        return $dataProvider;
    }

}
