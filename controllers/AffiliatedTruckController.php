<?php

namespace app\controllers;

use Yii;
use app\models\AffiliatedTruck;
use app\models\AffiliatedTruckSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AffiliatedTruckController implements the CRUD actions for AffiliatedTruck model.
 */
class AffiliatedTruckController extends Controller {

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
     * Lists all AffiliatedTruck models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new AffiliatedTruckSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AffiliatedTruck model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($company_id,$_id,$id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'id' => $_id,
                    'company_id' => $company_id,
        ]);
    }

    /**
     * Creates a new AffiliatedTruck model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($company_id = null, $id = null) {
        $model = new AffiliatedTruck();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['affiliated/view', 'id' => $id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
                        'company_id' => $company_id,
                        'id' => $id,
            ]);
        }
    }

    /**
     * Updates an existing AffiliatedTruck model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($company_id, $_id, $id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['affiliated/view', 'id' => $_id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'company_id' => $company_id,
                        'id' => $_id,
            ]);
        }
    }

    /**
     * Deletes an existing AffiliatedTruck model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($company_id, $id) {
        $this->findModel($id)->delete();
        return $this->redirect(['affiliated/view', 'id' => $company_id]);
    }

    /**
     * Finds the AffiliatedTruck model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AffiliatedTruck the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = AffiliatedTruck::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
