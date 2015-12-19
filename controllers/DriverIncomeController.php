<?php

namespace app\controllers;

use Yii;
use app\models\DriverIncome;
use app\models\DriverIncomeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DriverIncomeController implements the CRUD actions for DriverIncome model.
 */
class DriverIncomeController extends Controller
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
        ];
    }

    /**
     * Lists all DriverIncome models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DriverIncomeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DriverIncome model.
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
     * Creates a new DriverIncome model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DriverIncome();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing DriverIncome model.
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
     * Deletes an existing DriverIncome model.
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
     * Finds the DriverIncome model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DriverIncome the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DriverIncome::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionSave(){
        $request = \Yii::$app->request;
        $columns = array(
            "car_id" => $request->post('car_id'),
            "employee" => $request->post('employee'),
            "detail" => $request->post('detail_income'),
            "price" => $request->post('price_income'),
            "year" => $request->post('year_income'),
            "month" => $request->post('month_income'),
            "create_date" => date("Y-m-d H:i:s")
        );
        
        \Yii::$app->db->createCommand()
                ->insert("driver_income",$columns)
                ->execute();
    }
    
    public function actionLoad_income(){
        $driver = new DriverIncome();
        $request = \Yii::$app->request;
        $employee = $request->post('employee');
        $year = $request->post('year');
        $month = $request->post('month');
        $result = $driver->income($employee, $year, $month);
        
        return $this->renderPartial('load_income',[
            "income" => $result,
        ]);
    }
    
    public function actionDelete_income()
    {
        $id = Yii::$app->request->post('id');
        $this->findModel($id)->delete();

        //return $this->redirect(['index']);
    }
}
