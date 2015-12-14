<?php

namespace app\controllers;

use Yii;
use app\models\Customer;
use app\models\CustomerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\OrdersTransport;

/**
 * CustomerController implements the CRUD actions for Customer model.
 */
class CustomerController extends Controller {

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
     * Lists all Customer models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new CustomerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Customer model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Customer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Customer();

        if ($model->load(Yii::$app->request->post())) {

            $tax_number = $model->tax_number;
            $check = $model->find()->where(['tax_number' => $tax_number])->one();
            if ($check['tax_number'] != '') {
                $config = new \app\models\Config_system();
                $cusId = $config->autoId("customer", "cus_id", 7);
                return $this->render('create', [
                            'error' => "ลูกค้าบริษัทนี้นี้มีอยู่ในระบบแล้ว ...!",
                            'model' => $model,
                            'cus_id' => $cusId,
                ]);
            } else {
                $model->create_date = date("Y-m-d H:i:s");
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $config = new \app\models\Config_system();
            $cusId = $config->autoId("customer", "cus_id", 7);
            return $this->render('create', [
                        'error' => '',
                        'model' => $model,
                        'cus_id' => $cusId,
            ]);
        }
    }

    /**
     * Updates an existing Customer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->create_date = $model->create_date;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'cus_id' => $model->cus_id,
            ]);
        }
    }

    /**
     * Deletes an existing Customer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Customer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Customer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Customer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGet_history_transport() {
        $Model = new Customer();
        $employer = \Yii::$app->request->post('employer');
        $result = $Model->get_history_transport($employer);

        return $this->renderPartial('history_transport', [
                    'history' => $result,
        ]);
    }

    //รายลัเอียดการขนส่งของแต่ละใบปฏิบัติงาน
    public function actionDetail_transport($id = null) {
        $order_id = OrdersTransport::find()->where(['id' => $id])->one()['order_id'];
        $assign_model = new \app\models\Assign();
        //$outgoings_model = new \app\models\Outgoings();
        //$expenses_model = new \app\models\ExpensesTruck();
        //$outgoings = $outgoings_model->find()->where(['order_id' => $order_id])->all();
        //$expenses = $expenses_model->find()->where(['order_id' => $order_id])->all();
        $assign = $assign_model->find()->where(['order_id' => $order_id])->all();
        $model = OrdersTransport::findOne($id);

        $page = $this->renderPartial('detail_transport', [
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
    
    //ดึงข้อมูลลูกค้ามาแสดง
    public function actionGet_customer(){
        $model = CustomerSearch::find()->all();
        return $this->renderPartial('list_customer', [
            'model' => $model,
        ]);
    }

}
