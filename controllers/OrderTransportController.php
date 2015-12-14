<?php

namespace app\controllers;

use Yii;
use app\models\OrdersTransport;
use app\models\OrderTransportSearch;
use app\models\Assign;
use app\models\AssignSearch;
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
    public function actionIndex($error = null) {
//$searchModel = new OrderTransportSearch();
        if ($error == "1") {
            $error = "<i class='fa fa-warning'></i> ไม่สามารถ ลบ หรือ แก้ไข รายการนี้ได้ เนื่องจากมีการขนส่งของไปแล้ว ... !";
        } else {
            $error = "";
        }
        $searchModel = new AssignSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'error' => $error,
        ]);
    }

    /**
     * Displays a single OrdersTransport model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
//$config = new \app\models\Config_system();
        $model = AssignSearch::findOne($id);
//$assign_model = new \app\models\Assign();

        return $this->render('view', [
                    'model' => $model,
                        //'assign_id' => $assign_id,
        ]);
    }

    /**
     * Creates a new OrdersTransport model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Assign();
        $confix = new \app\models\Config_system();
        $id = $confix->autoId_order("assign", "assign_id", 5);
        $newId = substr(date("Y"), -2) . "-" . $id;

        return $this->render('create', [
                    'model' => $model,
                    'assign_id' => $newId,
        ]);
    }

    /**
     * Updates an existing OrdersTransport model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
//$model = $this->findModel($id);
        $sql = "SELECT * FROM assign WHERE id = '$id' AND (oil != '' OR gas != '' OR now_mile != '')";
        $rs = Yii::$app->db->createCommand($sql)->queryOne();
        if (!empty($rs)) {
            $error = "1";
            return $this->redirect(['index', 'error' => $error]);
        } else {
            $model = Assign::findOne($id);
            return $this->render('//assign/update', [
                        'model' => $model,
                        'assign_id' => $model->assign_id,
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
//$this->findModel($id)->delete();
//$columes = array("delete_flag" => '1');
//เช็คว่ารายการนี้ได้ขนส่งของจริงไหม ถ้า ขนส่งไปแล้วจะไม่สามารถลบได้ แต่ถ้าแค่ทำรายการ แต่รถยังไม่วิ่งจะยังลบหรือแก้ไขได้ อยู่

        $sql = "SELECT * FROM assign WHERE id = '$id' AND (oil != '' OR gas != '' OR now_mile != '')";
        $rs = Yii::$app->db->createCommand($sql)->queryOne();
        if (empty($rs)) {
            Yii::$app->db->createCommand()
                    ->delete("assign", "id = '$id' ")
                    ->execute();
            $error = "";
        } else {
            $error = "1";
        }
//return $this->actionIndex($error);

        return $this->redirect(['index', 'error' => $error]);
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
        if ($request->post('allowance_driver2') != '') {
            $driver_2 = $driver2 . "-" . $request->post('allowance_driver2');
        } else {
            $driver_2 = "";
        }
        $columns = array(
            "assign_id" => $request->post('assign_id'),
            "order_date_start" => $request->post('order_date_start'),
            "order_date_end" => $request->post('order_date_end'),
            "employer" => $request->post('employer'),
            "car_id" => $request->post('car_id'),
            "driver1" => $request->post('driver1'),
            "driver2" => $request->post('driver2'),
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
            "allowance_driver2" => $driver_2,
            "create_date" => date("Y-m-d H:i:s")
        );

        \Yii::$app->db->createCommand()
                ->insert("assign", $columns)
                ->execute();
    }

    public function actionUpdate_assign() {
        $request = \Yii::$app->request;

        $id = $request->post('id');

        $driver1 = $request->post('driver1');
        $driver2 = $request->post('driver2');
        if ($request->post('allowance_driver2') != '') {
            $driver_2 = $driver2 . "-" . $request->post('allowance_driver2');
        } else {
            $driver_2 = "";
        }
        $columns = array(
//"assign_id" => $request->post('assign_id'),
            "order_date_start" => $request->post('order_date_start'),
            "order_date_end" => $request->post('order_date_end'),
            "employer" => $request->post('employer'),
            "car_id" => $request->post('car_id'),
            "driver1" => $request->post('driver1'),
            "driver2" => $request->post('driver2'),
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
            "allowance_driver2" => $driver_2,
                //"create_date" => date("Y-m-d H:i:s")
        );

        \Yii::$app->db->createCommand()
                ->update("assign", $columns, "id = $id")
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
        $assign_id = $request->post('assign_id');
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
                ->update("assign", $columns, "assign_id = '$assign_id' ")
                ->execute();
    }

    public function actionSave_message() {
        $request = \Yii::$app->request;
        $assign_id = $request->post('assign_id');
        $message = $request->post('message');

        $columns = array(
            "message" => $message
        );

        Yii::$app->db->createCommand()
                ->update("assign", $columns, "assign_id = '$assign_id' ")
                ->execute();
    }

    public function actionDelete_assign() {
        $id = Yii::$app->request->post('id');
        Yii::$app->db->createCommand()
                ->delete("assign", "id = '$id'")
                ->execute();
    }

//ใบแจ้งหนี้
    public function actionBill($id = null) {
//$url = Url::to('web/html2pdf_v4.03/html2pdf.class.php');
//require $url;
        $model = AssignSearch::findOne($id);

        $page = $this->renderPartial('bill', [
            'model' => $model,
                //'assign' => $assign
        ]);

        $mpdf = new \mPDF('th', 'A4-P', '0', 'THSaraban');
        $mpdf->WriteHTML($page);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->Output($model->assign_id . ".pdf", "I");
    }

//รับ - จ่าย
    public function actionIncom_outcome($id = null) {
        $model = AssignSearch::findOne($id);

        $outgoings_model = new \app\models\Outgoings();
        $expenses_model = new \app\models\ExpensesTruck();
        $outgoings = $outgoings_model->find()->where(['assign_id' => $model->assign_id])->all();
        $expenses = $expenses_model->find()->where(['assign_id' => $model->assign_id])->all();


        $page = $this->renderPartial('_income_outcome', [
            'model' => $model,
            'outgoings' => $outgoings,
            'expenses' => $expenses,
        ]);

        $mpdf = new \mPDF('th', 'A4-P', '0', 'THSaraban');
        $mpdf->WriteHTML($page);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->Output($model->assign_id . ".pdf", "I");
    }

//ใบเสร็จ
    public function actionReceipt($id = null) {
        $model = AssignSearch::findOne($id);

        $page = $this->renderPartial('_receipt', [
            'model' => $model,
        ]);

        $mpdf = new \mPDF('th', 'A4-P', '0', 'THSaraban');
        $mpdf->WriteHTML($page);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->Output($model->assign_id . ".pdf", "I");
    }

    //ยืนยันการชำระเงิน 
    public function actionConfirm_order() {
        $id = Yii::$app->request->post('id');
        $columns = array('flag' => 1);
        Yii::$app->db->createCommand()
                ->update("assign", $columns, "id = '$id' ")
                ->execute();
    }

}
