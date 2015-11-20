<?php

namespace app\controllers;

use Yii;
use app\models\TruckAct;
use app\models\TruckActSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TruckActController implements the CRUD actions for TruckAct model.
 */
class TruckActController extends Controller {

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
     * Lists all TruckAct models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TruckActSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TruckAct model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TruckAct model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new TruckAct();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TruckAct model.
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
     * Deletes an existing TruckAct model.
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
     * Finds the TruckAct model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TruckAct the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = TruckAct::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionSave() {
        $license_plate = Yii::$app->request->post('license_plate');
        $columns = array(
                "license_plate" => $license_plate,
                "act_start" => Yii::$app->request->post('act_start'),
                "act_end" => Yii::$app->request->post('act_end'),
                "act_price" => Yii::$app->request->post('act_price'),
                "create_date" => date("Y-m-d H:i:s"),
        );

        Yii::$app->db->createCommand()
                ->insert("truck_act", $columns)
                ->execute();
    }

    public function actionLoad_act() {
        $license_plate = Yii::$app->request->post('license_plate');
        $truck_act = TruckAct::find()->where(['license_plate' => $license_plate])->orderBy(['act_end' => 'DESC'])->all();

        return $this->renderPartial('load_truck_act', [
                    "truck_act" => $truck_act,
        ]);
    }
    
    public function actionNotification(){
        $truck_act = new TruckAct();
        $notification = $truck_act->list_notification_act();
        
        return $this->render('notification',[
            "notification" => $notification,
        ]);
    }

}
