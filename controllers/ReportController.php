<?php

namespace app\controllers;

use yii\web\Controller;
use yii;
use app\models\Report;

class ReportController extends Controller {

    public $layout = "admin-lte";

    public function actionIndex() {
        
    }

    //รายงาน รายรับรายจ่าย ค่าขนส่งแยกตามประเภทรถ
    public function actionReport_income_expenses() {
        return $this->render('report_income_expenses', []);
    }

    public function actionLoad_report_income_expenses() {
        $report = new Report();
        $type = $report->Get_type();
        
        return $this->renderPartial('load_report_income_expenses', [
                    'type' => $type,
        ]);
    }
    
    public function actionReport_year(){
         return $this->render('report_year', [
        ]);
    }
    
    public function actionLoad_report_year() {
        $year = \Yii::$app->request->post('year');
        $report = new Report();
        $result = $report->Report_year($year);
        return $this->renderPartial('load_report_year', [
                    'report' => $result,
                    'year' => $year,
        ]);
    }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

