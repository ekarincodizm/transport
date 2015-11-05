<?php

namespace app\controllers;

use Yii;
use app\models\OrdersTransport;
use app\models\OrderTransportSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;
use yii\helpers\Url;

/**
 * OrderTransportController implements the CRUD actions for OrdersTransport model.
 */
class OrderTransportController extends Controller {

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
            // Yii::$app->response->format = Response::FORMAT_JSON;

            if (Yii::$app->request->post('orders-transport', null)) {
                $model->scenario = 'orders-transport';
                return ActiveForm::validate($model);
            }

            if ($model->load(Yii::$app->request->post())) {
                $model->create_date = date("Y-m-d H:i:s");
                $model->save();
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

    public function actionSave_before_release() {
        $oil_set = \Yii::$app->request->post('oil_set');
        $order_id = \Yii::$app->request->post('order_id');

        $columns = array(
            "oil_set" => $oil_set
        );

        \Yii::$app->db->createCommand()
                ->update("orders_transport", $columns, "order_id = '$order_id' ")
                ->execute();
        $json = $columns;
        echo json_encode($json);
    }

    public function actionSave_assign() {
        $request = \Yii::$app->request;
        $driver1 = $request->post('driver1');
        $driver2 = $request->post('driver2');
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
            "allowance_driver1" => $driver1 . "-" . $request->post('allowance_driver1'),
            "allowance_driver2" => $driver2 . "-" . $request->post('allowance_driver2'),
            "create_date" => date("Y-m-d H:i:s")
        );

        \Yii::$app->db->createCommand()
                ->insert("assign", $columns)
                ->execute();
    }

    public function actionReport($id = null, $assign_id = null) {
        //$url = Url::to('web/html2pdf_v4.03/html2pdf.class.php');
        //require $url;
        //$order_id = OrdersTransport::find()->where(['id' => $id])->one();
        $assign_model = new \app\models\Assign();
        $assign = $assign_model->find()->where(['assign_id' => $assign_id])->one();
        $model = $this->findModel($id);

        $page = $this->renderPartial('_reportView', [
            'model' => $model,
            'assign' => $assign,
            'assign_id' => $assign_id,
        ]);

        $mpdf = new \mPDF('th', 'A4-P', '0', 'THSaraban');
        $mpdf->WriteHTML($page);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->Output($assign_id . ".pdf", "I");
    }

   
    public function actionReportall($id = null) {

        $order_id = OrdersTransport::find()->where(['id' => $id])->one()->order_id;
        $assign_model = new \app\models\Assign();
        $assign = $assign_model->find()->where(['order_id' => $order_id])->all();

        $content = $this->renderPartial('_reportViewAll', [
            'model' => $this->findModel($id),
            'assigns' => $assign,
        ]);

        $mpdf = new \mPDF('th', 'A4-P', '0', 'THSaraban');
        $mpdf->WriteHTML($content);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->Output($order_id . ".pdf", "I");
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
            "gas_price" => $request->post('gas_price'),
            "old_mile" => $request->post('old_mile'),
            "now_mile" => $request->post('now_mile'),
            "distance" => $request->post('distance'),
            "avg_oil" => $request->post('avg_oil'),
            "compensate" => $request->post('compensate'),
        );

        \Yii::$app->db->createCommand()
                ->update("orders_transport", $columns, "order_id = '$order_id' ")
                ->execute();
    }

    public function actionSave_message() {
        $request = \Yii::$app->request;
        $order_id = $request->post('order_id');
        $message = $request->post('message');

        $columns = array(
            "message" => $message
        );

        Yii::$app->db->createCommand()
                ->update("orders_transport", $columns, "order_id = '$order_id' ")
                ->execute();
    }

    public function actionDelete_assign() {
        $id = Yii::$app->request->post('id');
        Yii::$app->db->createCommand()
                ->delete("assign", "id = '$id'")
                ->execute();
    }

}
