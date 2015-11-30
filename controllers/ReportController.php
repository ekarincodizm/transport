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
    public function actionReport_incom_expenses() {
        $report = new Report();
        $type = $report->Get_type();
        return $this->render('report_income_expenses',[
            'type' => $type,
        ]);
    }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

