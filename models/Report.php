<?php
namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Typecar;

class Report{
    function Get_type(){
        $type = Typecar::find()->all();
        return $type;
    }
    
    //กำไรขาดทุน รายปี
    function Report_year($year = null){
        $query = "SELECT m.month_th,
		SUM(Q1.TOTAL) AS around,
		SUM(Q1.distance) AS distance,
		SUM(Q1.oil) AS oil,
		SUM(Q1.income) AS income,
		SUM(Q1.oil_price) AS oil_price,
		SUM(Q1.gas) AS gas,
		SUM(Q1.gas_price) AS gas_price,
		SUM(Q1.expenses_around) AS expenses_around,/*ค่าใช้จ่ายระหว่างการเดินทาง*/
		SUM(Q1.fix_truck) AS fix_truck,
		SUM(Q1.income_driver) AS income_driver,/*จ่ายพนักงาน*/
		SUM(Q1.truck_period) AS truck_period,
		SUM(Q1.truck_act) AS truck_act
        FROM 
        (
                SELECT 
                                SUBSTR(o.order_date_start,6,2) AS MONTH,
                                COUNT(*) AS TOTAL,
                                SUM(o.distance) AS distance,
                                SUM(o.oil) AS oil,
                                SUM(a.income) AS income,
                                SUM(o.oil_price) AS oil_price,
                                SUM(o.gas) AS gas,
                                SUM(o.gas_price) AS gas_price,
                                (SUM(a.expenses_around) + IFNULL(SUM(u.price),0)) AS expenses_around,
                                0 AS fix_truck,
                                0 AS income_driver,
                                0 AS truck_period,
                                0 AS truck_act
                FROM orders_transport o 
                        INNER JOIN 
                        (
                        SELECT a.order_id,SUM(a.income) AS income,(TRIM(SUBSTR(a.allowance_driver1,7,10)) + TRIM(SUBSTR(a.allowance_driver2,7,10))) AS expenses_around
                        FROM assign a GROUP BY a.order_id
                        ) a 
        ON o.order_id = a.order_id
        LEFT JOIN outgoings u ON o.order_id = u.order_id
                WHERE YEAR(o.order_date_start) = '$year'
                GROUP BY SUBSTR(o.order_date_start,6,2)
        /*
                AND SUBSTR(o.order_date_start,6,2) = '11'
        */
                UNION 

                SELECT 
                        SUBSTR(o.order_date_start,6,2) AS MONTH,
                        COUNT(*) AS TOTAL,
                        0 AS distance,
                        0 AS oil,
                        o.income_total AS income,
                        0 AS oil_price,
                        0 AS gas,
                        0 AS gas_price,
                        0 AS expenses_around,
                        0 AS fix_truck,
                        0 AS income_driver,
                        0 AS truck_period,
                        0 AS truck_act
                FROM orders_transport_affiliated o 
                WHERE YEAR(o.order_date_start) = '$year'
                GROUP BY SUBSTR(o.order_date_start,6,2)
        /*
                AND SUBSTR(o.order_date_start,6,2) = '11'
        */

        UNION 

                SELECT 
                        SUBSTR(o.create_date,6,2) AS MONTH,
                        0 AS TOTAL,
                        0 AS distance,
                        0 AS oil,
                        0 AS income,
                        0 AS oil_price,
                        0 AS gas,
                        0 AS gas_price,
                        SUM(o.price) AS expenses_around,
                        0 AS fix_truck,
                        0 AS income_driver,
                        0 AS truck_period,
                        0 AS truck_act
                FROM expenses_truck o 
                WHERE YEAR(o.create_date) = '$year'
                GROUP BY SUBSTR(o.create_date,6,2)
        /*
                AND SUBSTR(o.create_date,6,2) = '11'
        */
        UNION 

                SELECT 
                        SUBSTR(o.create_date,6,2) AS MONTH,
                        0 AS TOTAL,
                        0 AS distance,
                        0 AS oil,
                        0 AS income,
                        0 AS oil_price,
                        0 AS gas,
                        0 AS gas_price,
                        0 AS expenses_around,
                        SUM(o.price) AS fix_truck,
                        0 AS income_driver,
                        0 AS truck_period,
                        0 AS truck_act
                FROM `repair` o 
                WHERE YEAR(o.create_date) = '$year'
                GROUP BY SUBSTR(o.create_date,6,2)
        /*
                AND SUBSTR(o.create_date,6,2) = '11'
        */
        /*จ่ายพนักงาน เงินเดือนและรายได้*/
        UNION 

                SELECT 
                        SUBSTR(o.date_salary,6,2) AS MONTH,
                        0 AS TOTAL,
                        0 AS distance,
                        0 AS oil,
                        0 AS income,
                        0 AS oil_price,
                        0 AS gas,
                        0 AS gas_price,
                        0 AS expenses_around,
                        0 AS fix_truck,
                        SUM(o.salary) AS income_driver,
                        0 AS truck_period,
                        0 AS truck_act
                FROM salary o 
                WHERE YEAR(o.date_salary) = '$year'
                GROUP BY SUBSTR(o.date_salary,6,2)
        /*
                AND SUBSTR(o.date_salary,6,2) = '11'
        */
        UNION 

                SELECT 
                        SUBSTR(o.create_date,6,2) AS MONTH,
                        0 AS TOTAL,
                        0 AS distance,
                        0 AS oil,
                        0 AS income,
                        0 AS oil_price,
                        0 AS gas,
                        0 AS gas_price,
                        0 AS expenses_around,
                        0 AS fix_truck,
                        SUM(o.price) AS income_driver,
                        0 AS truck_period,
                        0 AS truck_act
                FROM driver_income o 
                WHERE YEAR(o.create_date) = '$year'
                GROUP BY SUBSTR(o.create_date,6,2)
        /*
                AND SUBSTR(o.create_date,6,2) = '11'
        */
        /*ค่างวด*/
        UNION 

                SELECT 
                        o.`month` AS MONTH,
                        0 AS TOTAL,
                        0 AS distance,
                        0 AS oil,
                        0 AS income,
                        0 AS oil_price,
                        0 AS gas,
                        0 AS gas_price,
                        0 AS expenses_around,
                        0 AS fix_truck,
                        0 AS income_driver,
                        SUM(o.period_price) AS truck_period,
                        0 AS truck_act
                FROM annuities o 
                WHERE o.`year` = '$year'
                GROUP BY o.`month`
        /*
                AND o.`month` = '11'
        */
        /*ต่อภาษี*/
        UNION 

                SELECT 
                        SUBSTR(o.create_date,6,2) AS MONTH,
                        0 AS TOTAL,
                        0 AS distance,
                        0 AS oil,
                        0 AS income,
                        0 AS oil_price,
                        0 AS gas,
                        0 AS gas_price,
                        0 AS expenses_around,
                        0 AS fix_truck,
                        0 AS income_driver,
                        0 AS truck_period,
                        SUM(o.act_price) AS truck_act
                FROM truck_act o 
                WHERE YEAR(o.create_date) = '$year'
                GROUP BY SUBSTR(o.create_date,6,2)
                /*AND SUBSTR(o.create_date,6,2) = '11'
                */
        ) Q1

        RIGHT JOIN `month` m ON m.id = Q1.`MONTH`

        GROUP BY m.id";
        
        $result = \Yii::$app->db->createCommand($query)->queryAll();
        return $result;
    }
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

