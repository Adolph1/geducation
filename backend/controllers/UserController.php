<?php

namespace backend\controllers;

use backend\models\Employee;
use Yii;
use backend\models\User;
use backend\models\UserSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $arrayStatus = User::getArrayStatus();
        $arrayRole = User::getArrayRole();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'arrayStatus' => $arrayStatus,
            'arrayRole' => $arrayRole,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(yii::$app->User->can('createUser'))
        {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->authManager->assign(Yii::$app->authManager->getRole($model->role), $model->id);
        
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    else
    {

        Yii::$app->session->setFlash('danger', 'You dont have permition to create user.');
        return $this->redirect(['index']);
    }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->setScenario('admin-update');
        if(yii::$app->User->can('createUser')) {

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->authManager->revokeAll($id);
                Yii::$app->authManager->assign(Yii::$app->authManager->getRole($model->role), $id);
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
        else{
            Yii::$app->session->setFlash('danger', 'You dont have permition to update user.');
            return $this->redirect(['index']);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (yii::$app->User->can('createUser')) {
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash('danger', 'You dont have permition to delete user');
            return $this->redirect(['index']);
        }
    }




    public function actionProfile($id)
    {
        $model=$this->findModel($id);
        $emp=$this->findEmpModel($model->emp_id);
        $model->setScenario('admin-update');
        if($model->load(Yii::$app->request->post())) {
            Yii::$app->authManager->revokeAll($id);
            Yii::$app->authManager->assign(Yii::$app->authManager->getRole($model->role), $id);
            $model->save();
            Yii::$app->session->setFlash('success', 'You have successfully changed your password.');
            return $this->redirect(['profile', 'id' => $model->id]);
        }else {
            return $this->render('profile', [
                'model' => $this->findModel($id), 'emp' => $emp
            ]);
        }
    }
    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    protected function findEmpModel($id)
    {
        if (($model = Employee::find()->where(['id'=>$id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}
