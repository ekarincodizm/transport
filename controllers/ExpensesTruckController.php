<?php

namespace app\controllers;

use Yii;
use app\models\ExpensesTruck;
use app\models\ExpensesTruckSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ExpensesTruckController implements the CRUD actions for ExpensesTruck model.
 */
class ExpensesTruckController extends Controller {

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
     * Lists all ExpensesTruck models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ExpensesTruckSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ExpensesTruck model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ExpensesTruck model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new ExpensesTruck();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ExpensesTruck model.
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
     * Deletes an existing ExpensesTruck model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete() {
        $id = Yii::$app->request->post('id');
        $this->findModel($id)->delete();

        //return $this->redirect(['index']);
    }

    /**
     * Finds the ExpensesTruck model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ExpensesTruck the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ExpensesTruck::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionSave() {
        $order_id = \Yii::$app->request->post('order_id');
        $detail = \Yii::$app->request->post('detail');
        $price = \Yii::$app->request->post('price');
        $truck_license = Yii::$app->request->post('truck_license');
        $columns = array(
            "order_id" => $order_id,
            "truck_license" => $truck_license,
            "detail" => $detail,
            "price" => $price
        );

        \Yii::$app->db->createCommand()
                ->insert("expenses_truck", $columns)
                ->execute();
    }

    public function actionLoad_data() {
        $order_id = \Yii::$app->request->post('order_id');
        $Model = new ExpensesTruck();
        $result = $Model->find()->where(["order_id" => $order_id])->all();

        return $this->renderPartial('load', ["result" => $result]);
    }

}
