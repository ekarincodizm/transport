<?php

namespace app\controllers;

use Yii;
use app\models\Truck;
use app\models\TruckSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TruckController implements the CRUD actions for Truck model.
 */
class TruckController extends Controller {

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
     * Lists all Truck models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TruckSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Truck model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Truck model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Truck();

        if ($model->load(Yii::$app->request->post())) {
            //Yii::$app->request->post('Truck[license_plate]');
            $license_plate = $model->license_plate;
            $check = $model->find()->where(['license_plate' => $license_plate])->one();
            if ($check['license_plate'] != '') {
                return $this->render('create', [
                            'error' => "ทะเบียนรถนี้มีอยู่ในระบบแล้ว ...!",
                            'model' => $model,
                ]);
            } else {
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                        'error' => '',
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Truck model.
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
     * Deletes an existing Truck model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        //$this->findModel($id)->delete();
        $columns = array("delete_flag" => '1');
        Yii::$app->db->createCommand()
                ->update("truck", $columns, "id = '$id'")
                ->execute();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Truck model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Truck the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Truck::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionLoad_history() {
        $truck = new Truck();
        $id = \Yii::$app->request->post('id');
        $history = $truck->get_history($id);

        return $this->renderPartial('load_history', [
                    'history' => $history,
        ]);
    }

    public function actionLoad_repair() {
        $truck = new Truck();
        $license_plate = \Yii::$app->request->post('license_plate');
        $year = \Yii::$app->request->post('year');
        $month = \Yii::$app->request->post('month');
        $repair_order = $truck->get_repair_in_order($license_plate, $year, $month);

        return $this->renderPartial('load_repair', [
                    'repair_order' => $repair_order,
        ]);
    }

    public function actionGet_truck() {
        $result = Truck::find()->where(['delete_flag' => '0'])->orderBy(['id' => 'DESC'])->all();

        return $this->renderPartial('list_truck', [
                    "truck" => $result,
        ]);
    }

    public function actionLoad_price() {
        $truck = new Truck();
        $license_plate = \Yii::$app->request->post('license_plate');
        $year = \Yii::$app->request->post('year');
        $month = \Yii::$app->request->post('month');
        $price = $truck->get_price($license_plate, $year, $month);

        return $this->renderPartial('load_price', [
                    'model' => $price,
        ]);
    }

    public function actionGet_detail_truck() {
        $license_plate = Yii::$app->request->post('license_plate');
        $truck = new Truck();
        $t = $truck->find()->where(['license_plate' => $license_plate])->one();
        $id = $t['id'];
        return $this->renderPartial('detail', [
                    'model' => $this->findModel($id),
        ]);
    }

}
