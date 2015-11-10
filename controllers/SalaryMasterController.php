<?php

namespace app\controllers;

use Yii;
use app\models\SalaryMaster;
use app\models\SalaryMasterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SalaryMasterController implements the CRUD actions for SalaryMaster model.
 */
class SalaryMasterController extends Controller {

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
     * Lists all SalaryMaster models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new SalaryMasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SalaryMaster model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SalaryMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new SalaryMaster();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing SalaryMaster model.
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
     * Deletes an existing SalaryMaster model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SalaryMaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SalaryMaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = SalaryMaster::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionSalary_master() {
        $employee = Yii::$app->request->post('employee');
        $salary = SalaryMaster::find()->where(['employee' => $employee])
                ->orderBy(['id' => 'DESC'])
                ->all();
        return $this->renderPartial('salary_master', [
                    'model' => $salary,
        ]);
    }

    public function actionSave_salary_master() {
        $request = Yii::$app->request;
        $columns = array(
            "employee" => $request->post('employee'),
            "salary" => $request->post('salary'),
            "update_salary" => date("Y-m-d")
        );
        Yii::$app->db->createCommand()
                ->insert("salary_master", $columns)
                ->execute();
    }

    public function actionSet_salary() {
        $id = Yii::$app->request->post('id');
        $employee = Yii::$app->request->post('employee');
        $columns = array("active" => '0');
        Yii::$app->db->createCommand()
                ->update("salary_master", $columns, "employee = '$employee' ")
                ->execute();

        $columns_active = array("active" => '1');
        Yii::$app->db->createCommand()
                ->update("salary_master", $columns_active, "id = '$id' AND employee = '$employee' ")
                ->execute();
        
        $rs = SalaryMaster::find()->where(['employee' => $employee,'active' => 1])->one();
        $json = array("salary" => $rs['salary']);
        echo json_encode($json);
    }

}
