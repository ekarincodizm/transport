<?php

namespace app\controllers;

use Yii;
use app\models\MapTruck;
use app\models\MapTruckSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MapTruckController implements the CRUD actions for MapTruck model.
 */
class MapTruckController extends Controller {

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
     * Lists all MapTruck models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new MapTruckSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MapTruck model.
     * @param integer $id
     * @return mixed
     */
    public function actionView() {
        $model = new MapTruck();
        $car = $model->get_map_truck();
        return $this->renderPartial('view', [
                    'car' => $car,
        ]);
    }

    /**
     * Creates a new MapTruck model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new MapTruck();

        $truck1 = $model->get_truck_type1_noselect();
        $truck2 = $model->get_truck_type2_noselect();

        return $this->render('create', [
                    'truck1' => $truck1,
                    'truck2' => $truck2,
        ]);
    }

    /**
     * Updates an existing MapTruck model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->car_id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing MapTruck model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MapTruck model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MapTruck the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = MapTruck::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionSave() {
        $truck1 = Yii::$app->request->post('truck_1');
        $truck2 = Yii::$app->request->post('truck_2');

        $columns = array(
            'truck_1' => $truck1, 
            'truck_2' => $truck2,
            'create_date' => date('Y-m-d'),
            'status' => '0'
            );
        Yii::$app->db->createCommand()
                ->insert("map_truck", $columns)
                ->execute();
    }

    public function actionList_driver() {
        $car_id = Yii::$app->request->post('car_id');
        $driver_model = new \app\models\Driver();
        $driver = $driver_model->get_driver_not_car();

        return $this->renderPartial('list_driver', [
                    'driver' => $driver,
                    'car_id' => $car_id,
        ]);
    }

    //Map คนขับเข้ากับรถ คันที่
    public function actionMap_driver() {
        $car_id = Yii::$app->request->post('car_id');
        $driver_id = Yii::$app->request->post('driver_id');
        $update = array('active' => '0');
        Yii::$app->db->createCommand()
                ->update("map_driver", $update, "car_id = '$car_id' ")
                ->execute();

        $columns = array(
            'car_id' => $car_id,
            'driver' => $driver_id,
            'active' => '1',
            'create_date' => date("Y-m-d")
        );

        Yii::$app->db->createCommand()
                ->insert("map_driver", $columns)
                ->execute();
    }

}
