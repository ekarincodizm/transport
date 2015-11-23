<?php

namespace app\controllers;

use Yii;
use app\models\Annuities;
use app\models\AnnuitiesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;

/**
 * AnnuitiesController implements the CRUD actions for Annuities model.
 */
class AnnuitiesController extends Controller {
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
     * Lists all Annuities models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new AnnuitiesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Annuities model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Annuities model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Annuities();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Annuities model.
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
     * Deletes an existing Annuities model.
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
     * Finds the Annuities model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Annuities the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Annuities::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionLoad_annuities() {
        $license_plate = Yii::$app->request->post('license_plate');
        $sql = "SELECT * FROM annuities WHERE license_plate = '$license_plate' ORDER BY year,month ASC";
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        return $this->renderPartial('load_annuities', [
                    "result" => $result,
        ]);
    }

    public function actionSave() {
        $license_plate = Yii::$app->request->post('license_plate');
        $year = Yii::$app->request->post('year');
        $month = Yii::$app->request->post('month');
        $day = Yii::$app->request->post('day');
        $period_price = Yii::$app->request->post('period_price');

        $sql = "SELECT * FROM annuities WHERE license_plate = '$license_plate' AND month = '$month' AND year = '$year' ";
        $result = Yii::$app->db->createCommand($sql)->queryOne();

        if (!empty($result)) {
            echo "1";
        } else {

            $columns = array(
                "license_plate" => $license_plate,
                "day" => $day,
                "year" => $year,
                "month" => $month,
                "period_price" => $period_price,
                "create_date" => date("Y-m-d")
            );

            Yii::$app->db->createCommand()
                    ->insert("annuities", $columns)
                    ->execute();
        }
    }
    
    public function actionList_over(){
        $Model = new Annuities();
        $result = $Model->list_over();
        
        return $this->render('list_over',[
            "notification" => $result,
        ]);
    }

}
