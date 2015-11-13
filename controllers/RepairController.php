<?php

namespace app\controllers;

use Yii;
use app\models\Repair;
use app\models\RepairSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RepairController implements the CRUD actions for Repair model.
 */
class RepairController extends Controller
{
    public $layout = "admin-lte";
    public function behaviors()
    {
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
     * Lists all Repair models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RepairSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Repair model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($truck_license)
    {
       $repair = Repair::find()->where(['truck_license' => $truck_license])->orderBy(['create_date' => 'DESC'])->all();
        return $this->render('repair',[
            "truck_license" => $truck_license,
            "repair" => $repair,
        ]);
    }

    /**
     * Creates a new Repair model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($truck_license = null)
    {
        $model = new Repair();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'truck_license' => $truck_license]);
        } else {
            return $this->render('create', [
                'truck_license' => $truck_license,
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Repair model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'truck_license' => $model->truck_license,
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Repair model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Repair model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Repair the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Repair::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionForm_create($truck_license = null){
        $repair = Repair::find()->where(['truck_license' => $truck_license])->all();
        return $this->render('repair',[
            "truck_license" => $truck_license,
            "repair" => $repair,
        ]);
    }
}
