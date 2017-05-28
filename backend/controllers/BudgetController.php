<?php

namespace backend\controllers;

use backend\models\BudgetBalance;
use Yii;
use backend\models\Budget;
use backend\models\BudgetSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BudgetController implements the CRUD actions for Budget model.
 */
class BudgetController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Budget models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BudgetSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Budget model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Budget model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Budget();
        $model->maker_id = Yii::$app->user->identity->username;
        $model->maker_time = date('Y-m-d:H:i:s');
        $model->trn_dt= date('Y-m-d');


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $branch_balance=BudgetBalance::getBalance($model->branch_id);
            if($branch_balance!=null){

                BudgetBalance::updateAll(['balance'=>$branch_balance->balance+$model->amount],['branch_id'=>$model->branch_id]);
            }
            else{
                $modelBalance=new BudgetBalance();
                $modelBalance->branch_id=$model->branch_id;
                $modelBalance->balance=$model->amount;
                $modelBalance->last_updated=date('Y-m-d:H:i:s');
                $modelBalance->maker_id = Yii::$app->user->identity->username;
                $modelBalance->save();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Budget model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Budget model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Budget model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Budget the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Budget::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
