<?php

namespace app\controllers;

use Yii;
use app\models\Affiliated;
use app\models\AffiliatedSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\AffiliatedTruck;

/**
 * AffiliatedController implements the CRUD actions for Affiliated model.
 */
class AffiliatedController extends Controller {

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
     * Lists all Affiliated models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new AffiliatedSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Affiliated model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $model = $this->findModel($id);
        $AffiliatedTruck = new AffiliatedTruck();
        $truck = $AffiliatedTruck->find()->where(['company_id' => $model->company_id])->all();
        return $this->render('view', [
                    'model' => $model,
                    'truck' => $truck,
        ]);
    }

    /**
     * Creates a new Affiliated model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Affiliated();

        if ($model->load(Yii::$app->request->post())) {
            $model->create_date = date("Y-m-d H:i:s");
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $config = new \app\models\Config_system();
            $company_id = $config->autoId("affiliated", "company_id", 10);
            return $this->render('create', [
                        'model' => $model,
                        'company_id' => $company_id,
            ]);
        }
    }

    /**
     * Updates an existing Affiliated model.
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
                        'company_id' => $model->company_id,
            ]);
        }
    }

    /**
     * Deletes an existing Affiliated model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Affiliated model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Affiliated the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Affiliated::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
