<?php

namespace app\controllers;

use Yii;
use app\models\Repair;
use app\models\RepairSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RepairController implements the CRUD actions for Repair model.
 */
class RepairController extends Controller {

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
     * Lists all Repair models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new RepairSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Repair model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($truck_license) {
        $sql = "SELECT m.car_id FROM map_truck m WHERE (truck_1 = '$truck_license' OR truck_2 = '$truck_license') AND status = '0'";
        $rs = Yii::$app->db->createCommand($sql)->queryOne();
        $car_id = $rs['car_id'];
        return $this->render('repair', [
                    "car_id" => $car_id,
                    "truck_license" => $truck_license,
        ]);
    }

    public function actionLoad_repair() {
        $truck = new \app\models\Truck();
        $truck_license = Yii::$app->request->post('truck_licenses');
        $year = Yii::$app->request->post('year');
        $month = Yii::$app->request->post('month');

        $repair = $truck->get_repair_in_order($truck_license, $year, $month);
        return $this->renderPartial('load_repair', [
                    "truck_license" => $truck_license,
                    "repair" => $repair,
        ]);
    }

    /**
     * Creates a new Repair model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($truck_license = null,$car_id = null) {
        $model = new Repair();

        if ($model->load(Yii::$app->request->post())) {
            $model->car_id = $car_id;
            $model->save();
            return $this->redirect(['view', 'truck_license' => $truck_license]);
        } else {
            return $this->render('create', [
                        'truck_license' => $truck_license,
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Repair model.
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
                        'truck_license' => $model->truck_license,
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Repair model.
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
     * Finds the Repair model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Repair the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Repair::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionForm_create($truck_license = null) {
        $repair = Repair::find()->where(['truck_license' => $truck_license])->all();
        return $this->render('repair', [
                    "truck_license" => $truck_license,
                    "repair" => $repair,
        ]);
    }

}
