<?php

namespace app\controllers;

use Yii;
use app\models\EngineOil;
use app\models\EngineOilSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EngineOilController implements the CRUD actions for EngineOil model.
 */
class EngineOilController extends Controller
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
     * Lists all EngineOil models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EngineOilSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EngineOil model.
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
     * Creates a new EngineOil model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EngineOil();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing EngineOil model.
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
     * Deletes an existing EngineOil model.
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
     * Finds the EngineOil model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EngineOil the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EngineOil::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
     public function actionSave() {
        $license_plate = Yii::$app->request->post('license_plate');
        $columns = array(
                "car_id" => Yii::$app->request->post('car_id'),
                "license_plate" => $license_plate,
                "date_start" => Yii::$app->request->post('date_start'),
                "date_end" => Yii::$app->request->post('date_end'),
                "price" => Yii::$app->request->post('price'),
                "create_date" => date("Y-m-d H:i:s"),
        );

        Yii::$app->db->createCommand()
                ->insert("engine_oil", $columns)
                ->execute();
    }

    public function actionLoad_engine() {
        $license_plate = Yii::$app->request->post('license_plate');
        $engine= EngineOil::find()->where(['license_plate' => $license_plate])->orderBy(['date_end' => 'DESC'])->all();

        return $this->renderPartial('load_engine_oil', [
                    "engine" => $engine,
        ]);
    }
}
