<?php

namespace backend\controllers;

use Yii;
use backend\models\ExpenditureType;
use backend\models\Department;
use backend\models\ExpenditureTypeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ExpenditureTypeController implements the CRUD actions for ExpenditureType model.
 */
class ExpenditureTypeController extends Controller
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
     * Lists all ExpenditureType models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ExpenditureTypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ExpenditureType model.
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
     * Creates a new ExpenditureType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ExpenditureType();
        $model->maker_id=Yii::$app->user->identity->username;
        $model->maker_time=date('Y-m-d:H:i:s');



        if ($model->load(Yii::$app->request->post())) {
            if($_POST['ExpenditureType']['department_id']==null){
                $model->department_id=0;
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ExpenditureType model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->maker_id=Yii::$app->user->identity->username;
        $model->maker_time=date('Y-m-d:H:i:s');

        if ($model->load(Yii::$app->request->post())){
            if($_POST['ExpenditureType']['department_id']==null){
                $model->department_id=0;
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ExpenditureType model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }



    //gets user expenditures types


    public function actionFilter($id)
    {
        if(!yii::$app->User->can('Accountant')) {
            $countTypes = ExpenditureType::find()
                ->where(['department_id' => $id])
                ->count();

            $types = ExpenditureType::find()
                ->where(['department_id' => $id])
                ->orderBy('type ASC')
                ->all();

            if ($countTypes > 0) {
                echo "<option value=''>" . "--Select--" . "</option>";
                foreach ($types as $type) {

                    echo "<option value='" . $type->id . "'>" .$type->type."</option>";
                }
            } else {
                echo "<option> </option>";
            }
        }
        else{

            $countTypes = ExpenditureType::find()
                ->count();

            $types = ExpenditureType::find()
                ->orderBy('type ASC')
                ->all();

            if ($countTypes > 0) {
                echo "<option value=''>" . "--Select--" . "</option>";
                foreach ($types as $type) {

                    echo "<option value='" . $type->id . "'>".$type->type. " - " .Department::getDepartmentName($type->department_id)."</option>";
                }
            } else {
                echo "<option value=''>--Select--</option>";
            }
        }

    }

    /**
     * Finds the ExpenditureType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ExpenditureType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ExpenditureType::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
