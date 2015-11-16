<?php

namespace app\controllers;

use Yii;
use app\models\Outgoings;
use app\models\OutgoingsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OutgoingsController implements the CRUD actions for Outgoings model.
 */
class OutgoingsController extends Controller {

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
     * Lists all Outgoings models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new OutgoingsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Outgoings model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Outgoings model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Outgoings();

        if ($model->load(Yii::$app->request->post())) {
            $model->create_date = date("Y-m-d H:i:s");
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Outgoings model.
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
     * Deletes an existing Outgoings model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    /*
      public function actionDelete($id) {
      $this->findModel($id)->delete();

      return $this->redirect(['index']);
      }
     * 
     */

    /**
     * Finds the Outgoings model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Outgoings the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Outgoings::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionSave() {
        $order_id = \Yii::$app->request->post('order_id');
        $detail = \Yii::$app->request->post('detail');
        $price = \Yii::$app->request->post('price');

        $columns = array(
            "order_id" => $order_id,
            "detail" => $detail,
            "price" => $price,
            "create_date" => date("Y-m-d H:i:s"),
        );

        \Yii::$app->db->createCommand()
                ->insert("outgoings", $columns)
                ->execute();
    }

    public function actionLoad_data() {
        $order_id = \Yii::$app->request->post('order_id');
        $Model = new Outgoings();
        $result = $Model->find()->where(["order_id" => $order_id])->all();

        return $this->renderPartial('load', ["result" => $result]);
    }

    public function actionDelete() {
        $id = \Yii::$app->request->post('id');
        $this->findModel($id)->delete();
    }

}
