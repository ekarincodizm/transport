<?php

namespace app\controllers;

use Yii;
use app\models\OrdersTransportAffiliated;
use app\models\OrdersTransportAffiliatedSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;
use yii\helpers\Url;
use yii\helpers\Json;

/**
 * OrderTransportController implements the CRUD actions for OrdersTransport model.
 */
class OrdersTransportAffiliatedController extends Controller {

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
        $searchModel = new OrdersTransportAffiliatedSearch();
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
        $order_id = OrdersTransportAffiliated::find()->where(['id' => $id])->one()->order_id;
        $assign_model = new \app\models\AssignAffiliated();
        $assign = $assign_model->find()->where(['order_id' => $order_id])->one();
        //$assign_id = $config->autoId("assign_affiliated", "assign_id", 5);
        return $this->render('view', [
                    'model' => $this->findModel($id),
                    //'assign_id' => $assign_id,
                    'assign' => $assign,
        ]);
    }

    /**
     * Creates a new OrdersTransport model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new OrdersTransportAffiliated();
        $config = new \app\models\Config_system();
        $id = $config->autoId_order("orders_transport_affiliated", "order_id", 5);
        $newId = substr(date("Y"), -2) . "T-" . $id;

        if ($model->load(Yii::$app->request->post())) {
            // Yii::$app->response->format = Response::FORMAT_JSON;

            if (Yii::$app->request->post('orders-transport-affiliated', null)) {
                $model->scenario = 'orders-transport-affiliated';
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
        //$this->findModel($id)->delete();
        $columes = array("delete_flag" => '1');
        Yii::$app->db->createCommand()
                ->update("orders_transport_affiliated", $columes, "id = '$id' ")
                ->execute();
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
        if (($model = OrdersTransportAffiliated::findOne($id)) !== null) {
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
                ->update("orders_transport_affiliated", $columns, "order_id = '$order_id' ")
                ->execute();
        $json = $columns;
        echo json_encode($json);
    }

    public function actionSave_assign() {
        $request = \Yii::$app->request;
        $order_id = $request->post('order_id');
        $sql = "select * from assign_affiliated where order_id = '$order_id' ";
        $rs = Yii::$app->db->createCommand($sql)->queryOne();
        if (empty($rs)) {
            $columns = array(
                //"assign_id" => $request->post('assign_id'),
                "order_id" => $order_id,
                "transport_date" => $request->post('transport_date'),
                "cus_start" => $request->post('cus_start'),
                "cus_end" => $request->post('cus_end'),
                "changwat_start" => $request->post('changwat_start'),
                "changwat_end" => $request->post('changwat_end'),
                "product_type" => $request->post('product_type'),
                "weigh" => $request->post('weigh'),
                "type_calculus" => $request->post('type_calculus'),
                "unit_price" => $request->post('unit_price'),
                "per_times" => $request->post('per_times'),
                "income" => $request->post('income'),
                "create_date" => date("Y-m-d H:i:s")
            );
            \Yii::$app->db->createCommand()
                    ->insert("assign_affiliated", $columns)
                    ->execute();
        } else {
            $columns = array(
                //"assign_id" => $request->post('assign_id'),
                //"order_id" => $order_id,
                "transport_date" => $request->post('transport_date'),
                "cus_start" => $request->post('cus_start'),
                "cus_end" => $request->post('cus_end'),
                "changwat_start" => $request->post('changwat_start'),
                "changwat_end" => $request->post('changwat_end'),
                "product_type" => $request->post('product_type'),
                "weigh" => $request->post('weigh'),
                "type_calculus" => $request->post('type_calculus'),
                "unit_price" => $request->post('unit_price'),
                "per_times" => $request->post('per_times'),
                "income" => $request->post('income'),
                //"create_date" => date("Y-m-d H:i:s")
            );
            \Yii::$app->db->createCommand()
                    ->update("assign_affiliated", $columns, "order_id = '$order_id' ")
                    ->execute();
        }


        $columns_order = array(
            "income_total" => $request->post('income_total'),
            "price_affiliated" => $request->post('price_affiliated'),
            "price_employer" => $request->post('price_employer'),
            "message" => $request->post('message')
        );

        \Yii::$app->db->createCommand()
                ->update("orders_transport_affiliated", $columns_order, "order_id = '$order_id' ")
                ->execute();
    }

    public function actionReport($id = null, $assign_id = null) {
        //$url = Url::to('web/html2pdf_v4.03/html2pdf.class.php');
        //require $url;
        //$employer_model = new app\models\Affiliated();
        $assign_model = new \app\models\AssignAffiliated();
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

        $order_id = OrdersTransportAffiliated::find()->where(['id' => $id])->one()->order_id;
        $assign_model = new \app\models\AssignAffiliated();
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

    public function actionSave_message() {
        $request = \Yii::$app->request;
        $order_id = $request->post('order_id');
        $message = $request->post('message');
        $income_total = $request->post('income_total');
        $price_affiliated = $request->post('price_affiliated');
        $price_employer = $request->post('price_employer');
        $columns = array(
            "message" => $message,
            "income_total" => $income_total,
            "price_affiliated" => $price_affiliated,
            "price_employer" => $price_employer,
        );

        Yii::$app->db->createCommand()
                ->update("orders_transport_affiliated", $columns, "order_id = '$order_id' ")
                ->execute();
    }

    public function actionDelete_assign() {
        $id = Yii::$app->request->post('id');
        Yii::$app->db->createCommand()
                ->delete("assign_affiliated", "id = '$id'")
                ->execute();
    }

    //ใบแจ้งหนี้
    public function actionBill($id = null) {
        //$url = Url::to('web/html2pdf_v4.03/html2pdf.class.php');
        //require $url;
        $order_id = OrdersTransportAffiliated::find()->where(['id' => $id])->one()['order_id'];
        $assign_model = new \app\models\AssignAffiliated();
        $assign = $assign_model->find()->where(['order_id' => $order_id])->all();
        $model = $this->findModel($id);

        $page = $this->renderPartial('bill', [
            'model' => $model,
            'assign' => $assign
        ]);

        $mpdf = new \mPDF('th', 'A4-P', '0', 'THSaraban');
        $mpdf->WriteHTML($page);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->Output($order_id . ".pdf", "I");
    }

    //รับ - จ่าย
    public function actionIncom_outcome($id = null) {
        $order_id = OrdersTransportAffiliated::find()->where(['id' => $id])->one()['order_id'];
        $assign_model = new \app\models\AssignAffiliated();
        //$outgoings_model = new \app\models\Outgoings();
        //$expenses_model = new \app\models\ExpensesTruck();
        //$outgoings = $outgoings_model->find()->where(['order_id' => $order_id])->all();
        //$expenses = $expenses_model->find()->where(['order_id' => $order_id])->all();
        $assign = $assign_model->find()->where(['order_id' => $order_id])->all();
        $model = $this->findModel($id);

        $page = $this->renderPartial('_income_outcome', [
            'model' => $model,
            'assigns' => $assign,
            //'outgoings' => $outgoings,
            //'expenses' => $expenses,
            'order_id' => $order_id,
        ]);

        $mpdf = new \mPDF('th', 'A4-P', '0', 'THSaraban');
        $mpdf->WriteHTML($page);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->Output($order_id . ".pdf", "I");
    }

    //ใบเสร็จ
    public function actionReceipt($id = null) {
        $order_id = OrdersTransportAffiliated::find()->where(['id' => $id])->one()['order_id'];
        $assign_model = new \app\models\AssignAffiliated();
        //$outgoings_model = new \app\models\Outgoings();
        //$expenses_model = new \app\models\ExpensesTruck();
        //$outgoings = $outgoings_model->find()->where(['order_id' => $order_id])->all();
        //$expenses = $expenses_model->find()->where(['order_id' => $order_id])->all();
        $assign = $assign_model->find()->where(['order_id' => $order_id])->all();
        $model = $this->findModel($id);

        $page = $this->renderPartial('_receipt', [
            'model' => $model,
            'assigns' => $assign,
                //'outgoings' => $outgoings,
                //'expenses' => $expenses,
                //'order_id' => $order_id,
        ]);

        $mpdf = new \mPDF('th', 'A4-P', '0', 'THSaraban');
        $mpdf->WriteHTML($page);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->Output($order_id . ".pdf", "I");
    }

    protected function MapData($datas, $fieldId, $fieldName) {
        $obj = [];
        foreach ($datas as $key => $value) {
            array_push($obj, ['id' => $value->{$fieldId}, 'name' => $value->{$fieldName}]);
        }
        return $obj;
    }

    public function actionGet_truck() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $company_id = $parents[0];
                $datas = \app\models\AffiliatedTruck::find()->where(['company_id' => $company_id])->all();
                $out = $this->MapData($datas, 'id', 'license_plate');
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }

        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionGet_truck2() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $company_id = $parents[0];
                $datas = \app\models\AffiliatedTruck::find()->where(['company_id' => $company_id])->all();
                $out = $this->MapData($datas, 'id', 'license_plate');
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }

        echo Json::encode(['output' => '', 'selected' => '']);
    }

}
