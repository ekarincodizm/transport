<?php

namespace app\controllers;

use Yii;
use app\models\Salary;
use app\models\SalarySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SalaryController implements the CRUD actions for Salary model.
 */
class SalaryController extends Controller {

    public $layout = "admin-lte";

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Salary models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new SalarySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Salary model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Salary model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Salary();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Salary model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
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
     * Deletes an existing Salary model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Salary model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Salary the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Salary::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionLoad_salary() {
        $Model = new Salary();
        $employee = \Yii::$app->request->post('employee');
        $salary = $Model->getsalary_one($employee);

        return $this->renderPartial('load_salary', [
                    'salary' => $salary
        ]);
    }

    public function actionSave() {
        $request = Yii::$app->request;
        $columns = array(
            "employee" => $request->post('employee'),
            "salary" => $request->post('salary'),
            "month" => $request->post('month'),
            "year" => $request->post('year'),
            "date_salary" => date("Y-m-d")
        );

        Yii::$app->db->createCommand()
                ->insert("salary", $columns)
                ->execute();
    }
    
    public function actionDelete_salary(){
        $id = \Yii::$app->request->post('id');
        \Yii::$app->db->createCommand()
                ->delete("salary","id = '$id' ")
                ->execute();
    }

}
