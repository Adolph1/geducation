<?php

namespace backend\controllers;

use backend\models\Branch;
use backend\models\Employee;
use Yii;
use backend\models\Report;
use backend\models\ReportSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ReportController implements the CRUD actions for Report model.
 */
class ReportController extends Controller
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
     * Lists all Report models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Report();

        if(isset($_GET['ReportSearch'])) {
            if (yii::$app->User->can('Accountant')) {
                $searchModel = new ReportSearch();
                $branch = $_GET['ReportSearch']['branch'];
                $from = $_GET['ReportSearch']['from'];
                $to = $_GET['ReportSearch']['to'];

                $dataProvider = $searchModel->search($branch, '', '');
                return $this->render('report', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model,
                    'from' => $from,
                    'to' => $to,
                ]);
            } elseif (yii::$app->User->can('BranchManager')) {
                $searchModel = new ReportSearch();
                $from = $_GET['ReportSearch']['from'];
                $to = $_GET['ReportSearch']['to'];
                $branch = Employee::getBranchID(Yii::$app->user->identity->emp_id);
                $dataProvider = $searchModel->search($branch, '', '');
                return $this->render('report', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model,
                    'from' => $from,
                    'to' => $to,
                ]);
            }
        }
            else{
                $searchModel = new ReportSearch();
                $dataProvider = $searchModel->search('', '', '');
                return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model,
                ]);

            }




    }

    /**
     * Displays a single Report model.
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
     * Creates a new Report model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Report();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Report model.
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
     * Deletes an existing Report model.
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
     * Finds the Report model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Report the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Report::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * gets today sales report
     */

    public function actionTodaysales()
    {
        return $this->render('today_sales');
    }
}
