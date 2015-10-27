<?php

namespace app\controllers;

use Yii;
use app\models\OrdersTransport;
use app\models\OrderTransportSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;

/**
 * OrderTransportController implements the CRUD actions for OrdersTransport model.
 */
class OrderTransportController extends Controller {

    public $layout = "transport";

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
     * Lists all OrdersTransport models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new OrderTransportSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OrdersTransport model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $config = new \app\models\Config_system();
        $order_id = OrdersTransport::find()->where(['id' => $id])->one()->order_id;
        $assign_model = new \app\models\Assign();
        $assign = $assign_model->find()->where(['order_id' => $order_id])->all();
        $assign_id = $config->autoId("assign", "assign_id", 5);
        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'assign_id' => $assign_id,
                    'assign' => $assign,
        ]);
    }

    /**
     * Creates a new OrdersTransport model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new OrdersTransport();
        $confix = new \app\models\Config_system();
        $id = $confix->autoId_order("orders_transport", "order_id", 5);
        $newId = substr(date("Y"), -2) . "-" . $id;

        if ($model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            if (Yii::$app->request->post('orders-transport', null)) {
                $model->scenario = 'orders-transport';
                return ActiveForm::validate($model);
            }

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
                        'order_id' => $newId,
            ]);
        }
    }

    /**
     * Updates an existing OrdersTransport model.
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
                        'order_id' => $model->order_id,
            ]);
        }
    }

    /**
     * Deletes an existing OrdersTransport model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the OrdersTransport model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OrdersTransport the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = OrdersTransport::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionSave_set_oil() {
        $oil_set = \Yii::$app->request->post('oil_set');
        $order_id = \Yii::$app->request->post('order_id');

        $columns = array(
            "oil_set" => $oil_set
        );

        \Yii::$app->db->createCommand()
                ->update("orders_transport", $columns, "order_id = '$order_id' ")
                ->execute();
        $json = array("oil" => $oil_set);
        echo json_encode($json);
    }

    public function actionSave_assign() {
        $request = \Yii::$app->request;

        $columns = array(
            "assign_id" => $request->post('assign_id'),
            "order_id" => $request->post('order_id'),
            "transport_date" => $request->post('transport_date'),
            "cus_start" => $request->post('cus_start'),
            "cus_end" => $request->post('cus_end'),
            "changwat_start" => $request->post('changwat_start'),
            "changwat_end" => $request->post('changwat_end'),
            "product_type" => $request->post('product_type'),
            "weigh" => $request->post('weigh'),
            "oil_set" => $request->post('oil_set'),
            "type_calculus" => $request->post('type_calculus'),
            "unit_price" => $request->post('unit_price'),
            "per_times" => $request->post('per_times'),
            "income" => $request->post('income'),
            "allowance_driver1" => $request->post('allowance_driver1'),
            "allowance_driver2" => $request->post('allowance_driver2')
        );

        \Yii::$app->db->createCommand()
                ->insert("assign", $columns)
                ->execute();
    }

    public function actionReport() {
        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('_reportView');

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
            // set mPDF properties on the fly
            'options' => ['title' => 'Krajee Report Title'],
            // call mPDF methods on the fly
            'methods' => [
                'SetHeader' => ['Krajee Report Header'],
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);

        // return the pdf output as per the destination setting
        return $pdf->render();
    }

    public function actionSave_fuel() {
        $request = \Yii::$app->request;
        $order_id = $request->post('order_id');
        $columns = array(
            "oil" => $request->post('oil'),
            "oil_unit" => $request->post('oil_unit'),
            "oil_price" => $request->post('oil_price'),
            "gas" => $request->post('gas'),
            "gas_unit" => $request->post('gas_unit'),
            "gas_price" => $request->post('gas_price')
        );

        \Yii::$app->db->createCommand()
                ->update("orders_transport", $columns, "order_id = '$order_id' ")
                ->execute();
    }

}
