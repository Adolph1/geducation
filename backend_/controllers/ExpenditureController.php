<?php

namespace backend\controllers;

use backend\models\Branch;
use Yii;
use backend\models\Expenditure;
use backend\models\ExpenditureSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ExpenditureController implements the CRUD actions for Expenditure model.
 */
class ExpenditureController extends Controller
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
     * Lists all Expenditure models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(yii::$app->User->can('BranchManager')) {

            $searchModel = new ExpenditureSearch();
            $dataProvider = $searchModel->searchByUser(Yii::$app->request->queryParams);
            if($dataProvider!=null){
                return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            }
            else{
                $model=new Expenditure();
                return $this->render('create', [
                    'model' => $model,
                ]);

            }
        }
        elseif (yii::$app->User->can('Accountant')||yii::$app->User->can('admin')){
            $searchModel = new ExpenditureSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }

    }


    public function actionPending()
    {
        if(yii::$app->User->can('BranchManager')) {

            $searchModel = new ExpenditureSearch();
            $dataProvider = $searchModel->searchPendingByUser(Yii::$app->request->queryParams);
            if($dataProvider!=null){
                return $this->render('pending', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            }
            else{
                $model=new Expenditure();
                return $this->render('create', [
                    'model' => $model,
                ]);

            }
        }
        elseif (yii::$app->User->can('Accountant')||yii::$app->User->can('admin')){
            $searchModel = new ExpenditureSearch();
            $dataProvider = $searchModel->searchPending(Yii::$app->request->queryParams);

            return $this->render('pending', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }

    }

    /**
     * Displays a single Expenditure model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(yii::$app->User->can('BranchManager')) {
            $model = $this->findModel($id);
            if($model->branch_id==\backend\models\Employee::getBranchID(Yii::$app->user->identity->emp_id) && $model->department_id==\backend\models\Employee::getDepartmentID(Yii::$app->user->identity->emp_id)) {
                return $this->render('view', [
                    'model' => $this->findModel($id),
                ]);
            }
            else
            {
                Yii::$app->session->setFlash('danger', 'You dont have permission to view this expenditure.');
                return $this->redirect(['index']);
            }

        }
        elseif(yii::$app->User->can('Accountant')){
            $model = $this->findModel($id);
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new Expenditure model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(yii::$app->User->can('createExpenditure')) {
            $model = new Expenditure();
            $model->branch_id=\backend\models\Employee::getBranchID(Yii::$app->user->identity->emp_id);
            $model->department_id=\backend\models\Employee::getDepartmentID(Yii::$app->user->identity->emp_id);
            $model->maker_id=Yii::$app->user->identity->username;
            $model->maker_time=date('Y-m-d:H:i:s');
            $model->status='U';

            if ($model->load(Yii::$app->request->post())) {
                $model->attachment = UploadedFile::getInstance($model, 'attachment_file');
                if ($model->attachment!=null) {
                    $model->save();
                    $model->attachment->saveAs('uploads/' . Branch::getBranchName($model->branch_id).'--'.$model->id . '.' . $model->attachment->extension);
                    $model->attachment = Branch::getBranchName($model->branch_id).'--'.$model->id . '.' . $model->attachment->extension;
                    $model->save();
                    return $this->redirect(['view', 'id' => $model->id]);
                }
                else
                {
                    $model->save();
                    return $this->redirect(['view', 'id' => $model->id]);
                }

            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
        else
        {

            Yii::$app->session->setFlash('danger', 'You dont have permission to create expenditure.');
            return $this->redirect(['index']);
        }
    }

    /**
     * Updates an existing Expenditure model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if(yii::$app->User->can('createExpenditure')) {

            if ($model->status == 'U') {

                if(yii::$app->User->can('Accountant')) {
                    $model->checker = Yii::$app->user->identity->username;
                    $model->checker_time = date('Y-m-d:H:i:s');
                    $model->status = 'A';
                }
                elseif (yii::$app->User->can('BranchManager')){
                    $model->branch_id = \backend\models\Employee::getBranchID(Yii::$app->user->identity->emp_id);
                    $model->department_id = \backend\models\Employee::getDepartmentID(Yii::$app->user->identity->emp_id);
                    $model->maker_id=Yii::$app->user->identity->username;
                    $model->maker_time=date('Y-m-d:H:i:s');
                }
                if ($model->load(Yii::$app->request->post())) {
                    $model->attachment = UploadedFile::getInstance($model, 'attachment_file');
                    if ($model->attachment != null) {
                        $model->save();
                        $model->attachment->saveAs('uploads/' . Branch::getBranchName($model->branch_id) . '--' . $model->id . '.' . $model->attachment->extension);
                        $model->attachment = Branch::getBranchName($model->branch_id) . '--' . $model->id . '.' . $model->attachment->extension;
                        $model->save();
                    }
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    return $this->render('update', [
                        'model' => $model,
                    ]);
                }
            } else {

                Yii::$app->session->setFlash('danger', 'You cant update the authorised expenditure.');
                return $this->redirect(['index']);
            }
        }
        else{
            Yii::$app->session->setFlash('danger', 'You dont have permission to update expenditure.');
            return $this->redirect(['index']);
        }
    }

    /**
     * Deletes an existing Expenditure model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {

        $model=$this->findModel($id);
        if($model->status=='U') {
            $model->delete_stat = 'D';
            $model->maker_id = Yii::$app->user->identity->username;
            $model->maker_time = date('Y-m-d:H:i:s');
            $model->save();
            return $this->redirect(['index']);
        }
        elseif($model->status=='A') {
            Yii::$app->session->setFlash('danger', 'You cant delete the authorised expenditure.');
            return $this->redirect(['index']);
        }

    }

    /*
     * approves an expenditure
     */
    public function actionApprove($id)
    {

        $model=$this->findModel($id);
        if(yii::$app->User->can('verifyExpenditure')) {
            $model->status = 'A';
            $model->checker = Yii::$app->user->identity->username;
            $model->checker_time = date('Y-m-d:H:i:s');
            $model->save();
            return $this->redirect(['index']);
        }
        else{
            Yii::$app->session->setFlash('danger', 'You dont have permission to approve the expenditure.');
            return $this->redirect(['index']);
        }

    }




    /**
     * Finds the Expenditure model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Expenditure the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Expenditure::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
