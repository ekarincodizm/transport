<?php

namespace app\controllers;

use Yii;
use app\models\DriverExpenses;
use app\models\DriverExpensesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DriverExpensesController implements the CRUD actions for DriverExpenses model.
 */
class DriverExpensesController extends Controller
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
     * Lists all DriverExpenses models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DriverExpensesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DriverExpenses model.
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
     * Creates a new DriverExpenses model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DriverExpenses();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing DriverExpenses model.
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
     * Deletes an existing DriverExpenses model.
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
     * Finds the DriverExpenses model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DriverExpenses the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DriverExpenses::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionSave(){
        $request = \Yii::$app->request;
        $columns = array(
            "employee" => $request->post('employee'),
            "detail" => $request->post('detail_expenses'),
            "price" => $request->post('price_expenses'),
            "year" => $request->post('year_expenses'),
            "month" => $request->post('month_expenses'),
            "create_date" => date("Y-m-d H:i:s")
        );
        
        \Yii::$app->db->createCommand()
                ->insert("driver_expenses",$columns)
                ->execute();
    }
    
    public function actionLoad_expenses(){
        $driver = new DriverExpenses();
        $request = \Yii::$app->request;
        $employee = $request->post('employee');
        $year = $request->post('year');
        $month = $request->post('month');
        $result = $driver->find()
                ->where(['employee' => $employee])
                ->andWhere(['year' => $year])
                ->andWhere(['month' => $month])
                ->all();
        
        return $this->renderPartial('load_expenses',[
            "expenses" => $result,
        ]);
    }
    
}
