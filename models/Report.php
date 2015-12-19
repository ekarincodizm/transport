<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Typecar;

class Report {

    function Get_type() {
        $type = Typecar::find()->all();
        return $type;
    }

    //กำไรขาดทุน รายปี
    function Report_year($year = null) {
        $query = "SELECT m.id,m.month_th,
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
                        SUM(o.income_total) AS income,
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
                        SUM(o.period_price) AS truck_period,
                        0 AS truck_act
                FROM annuities o 
                WHERE YEAR(o.create_date) = '$year'
                GROUP BY SUBSTR(o.create_date,6,2)
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

    //Report กำไร - ขาดทุน รายเดือน หมายเหตุ คิดจากวันที่บันทึก
    function Report_month($year, $month) {
        $query = "SELECT Q1.`DAY`,
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
                                SUBSTR(o.order_date_start,9,2) AS DAY,
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
                        AND SUBSTR(o.order_date_start,6,2) = '$month' 
                GROUP BY SUBSTR(o.order_date_start,9,2)
        /*
                AND SUBSTR(o.order_date_start,6,2) = '11'
        */
                UNION 

                SELECT 
                        SUBSTR(o.order_date_start,9,2) AS DAY,
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
                                AND SUBSTR(o.order_date_start,6,2) = '$month' 
                GROUP BY SUBSTR(o.order_date_start,9,2)
        /*
                AND SUBSTR(o.order_date_start,6,2) = '11'
        */

        UNION 

                SELECT 
                        SUBSTR(o.create_date,9,2) AS DAY,
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
                        AND SUBSTR(o.create_date,6,2) = '$month' 
                GROUP BY SUBSTR(o.create_date,9,2)
        /*
                AND SUBSTR(o.create_date,6,2) = '11'
        */
        UNION 

                SELECT 
                        SUBSTR(o.create_date,9,2) AS DAY,
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
                AND SUBSTR(o.create_date,6,2) = '$month' 
                GROUP BY SUBSTR(o.create_date,9,2)
        /*
                AND SUBSTR(o.create_date,6,2) = '11'
        */
        /*จ่ายพนักงาน เงินเดือนและรายได้*/
        UNION 

                SELECT 
                        SUBSTR(o.date_salary,9,2) AS DAY,
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
                        AND SUBSTR(o.date_salary,6,2) = '$month' 
                GROUP BY SUBSTR(o.date_salary,9,2)
        /*
                AND SUBSTR(o.date_salary,6,2) = '11'
        */
        UNION 

                SELECT 
                        SUBSTR(o.create_date,9,2) AS DAY,
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
                        AND SUBSTR(o.create_date,6,2) = '$month' 
                GROUP BY SUBSTR(o.create_date,9,2)
        /*
                AND SUBSTR(o.create_date,6,2) = '11'
        */
        /*ค่างวด*/
        UNION 

                SELECT 
                        SUBSTR(o.create_date,9,2) AS DAY,
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
                WHERE YEAR(o.create_date) = '$year'
                        AND SUBSTR(o.create_date,6,2) = '$month' 
                GROUP BY SUBSTR(o.create_date,9,2)
        /*
                AND o.`month` = '11'
        */
        /*ต่อภาษี*/
        UNION 

                SELECT 
                        SUBSTR(o.create_date,9,2) AS DAY,
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
                        AND SUBSTR(o.create_date,6,2) = '$month' 
                GROUP BY SUBSTR(o.create_date,9,2)
                /*AND SUBSTR(o.create_date,6,2) = '11'
                */
        ) Q1

        /*RIGHT JOIN `month` m ON m.id = Q1.`MONTH`*/

        GROUP BY Q1.`DAY`";

        $result = \Yii::$app->db->createCommand($query)->queryAll();
        return $result;
    }

    function Report_period($year = null, $period = null) {
        if ($period == '1') {
            $M_start = "01";
            $M_end = "03";
        } else if ($period == '2') {
            $M_start = "04";
            $M_end = "06";
        } else if ($period == '3') {
            $M_start = "07";
            $M_end = "09";
        } else {
            $M_start = "10";
            $M_end = "12";
        }
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
                    AND SUBSTR(o.order_date_start,6,2) BETWEEN '$M_start' AND '$M_end'
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
                            SUM(o.income_total) AS income,
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
                            AND SUBSTR(o.order_date_start,6,2) BETWEEN '$M_start' AND '$M_end'
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
                            AND SUBSTR(o.create_date,6,2) BETWEEN '$M_start' AND '$M_end'
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
                            AND SUBSTR(o.create_date,6,2) BETWEEN '$M_start' AND '$M_end'
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
                                    AND SUBSTR(o.date_salary,6,2) BETWEEN '$M_start' AND '$M_end'
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
                            AND SUBSTR(o.create_date,6,2) BETWEEN '$M_start' AND '$M_end'
                    GROUP BY SUBSTR(o.create_date,6,2)
            /*
                    AND SUBSTR(o.create_date,6,2) = '11'
            */
            /*ค่างวด*/
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
                            SUM(o.period_price) AS truck_period,
                            0 AS truck_act
                    FROM annuities o 
                    WHERE YEAR(o.create_date) = '$year'
                            AND SUBSTR(o.create_date,6,2) BETWEEN '$M_start' AND '$M_end'
                    GROUP BY SUBSTR(o.create_date,6,2)
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
                            AND SUBSTR(o.create_date,6,2) BETWEEN '$M_start' AND '$M_end'
                    GROUP BY SUBSTR(o.create_date,6,2)
                    /*AND SUBSTR(o.create_date,6,2) = '11'
                    */
            ) Q1

            RIGHT JOIN `month` m ON m.id = Q1.`MONTH`

            WHERE m.id BETWEEN '$M_start' AND '$M_end'

            GROUP BY m.id";
        $result = \Yii::$app->db->createCommand($query)->queryAll();
        return $result;
    }
    
    //ดึงข้อมูลรายงานรายรับ รายจ่าย ทั้งหมดของรถแต่ละคัน
    function report_month_all($year = null,$month = null){
        $sql = "SELECT a.car_id,t.truck_1,t.truck_2,d.driver,dv.`name`,dv.lname,
                SUM(a.oil_set) AS oil_set,
                                SUM(a.oil) AS oil,
                                SUM(a.oil_unit) AS oil_unit,
                                SUM(a.oil_price) AS oil_price,
                                SUM(a.gas) AS gas,
                                SUM(a.gas_unit) AS gas_unit,
                                SUM(a.gas_price) AS gas_price,
                                SUM(a.distance) AS distance,
                                SUM(a.weigh) AS weigh,
                                SUM(a.income) AS income,
                                SUM(TRIM(SUBSTR(a.allowance_driver1,7,10))) AS allowance_driver1,
                                SUM(TRIM(SUBSTR(a.allowance_driver2,7,10))) AS allowance_driver2
                FROM assign a INNER JOIN map_truck t ON a.car_id = t.car_id
                LEFT JOIN map_driver d ON t.car_id = d.car_id
                LEFT JOIN driver dv ON d.driver = dv.driver_id
                WHERE LEFT(a.order_date_start,4) = '$year'
                AND SUBSTR(order_date_start,6,2) = '$month'
                GROUP BY a.car_id";
         $result = \Yii::$app->db->createCommand($sql)->queryAll();
        return $result;
    }
    
    //หาค่ารอบของรถคันนั้น
    function get_around($year = null,$month = null,$car_id = null){
        $sql = "SELECT COUNT(*) AS TOTAL
                FROM assign a INNER JOIN map_truck t ON a.car_id = t.car_id
                LEFT JOIN map_driver d ON t.car_id = d.car_id
                LEFT JOIN driver dv ON d.driver = dv.driver_id
                WHERE LEFT(a.order_date_start,4) = '$year'
                    AND SUBSTR(order_date_start,6,2) = '$month'
                    AND a.car_id = '$car_id'";
         $result = \Yii::$app->db->createCommand($sql)->queryOne();
        return $result['TOTAL'];
    }
    
    //หาค่าใชช้จ่ายในการเดินทางของรถแต่ละคัน ใน เดือนนั้น ๆ 
    function sum_get_outgoing($year = null,$month = null,$car_id = null){
        $sql = "SELECT SUM(o.price) AS price
                FROM assign a INNER JOIN outgoings o ON a.assign_id = o.assign_id
                WHERE a.car_id = '$car_id' 
                        AND YEAR(a.order_date_start) = '$year'
                        AND SUBSTR(a.order_date_start,6,2) = '$month' ";
        $result = \Yii::$app->db->createCommand($sql)->queryOne();
        return $result['price'];
    }
    
    //ดึงรายการค่าใชช้จ่ายในการเดินทางของรถแต่ละคัน ใน เดือนนั้น ๆ 
    function get_outgoing($year = null,$month = null,$car_id = null){
        $sql = "SELECT o.detail,o.price,o.create_date
                FROM assign a INNER JOIN outgoings o ON a.assign_id = o.assign_id
                WHERE a.car_id = '$car_id' 
                        AND YEAR(a.order_date_start) = '$year'
                        AND SUBSTR(a.order_date_start,6,2) = '$month' ";
        $result = \Yii::$app->db->createCommand($sql)->queryAll();
        return $result;
    }
    
    //ดึงจำนวนค่าซ่อมรถทั้งหมดมาแสดง
    function sum_expenses_truck($year = null,$month = null,$car_id = null){
        $sql = "SELECT SUM(Q1.price) AS price
                FROM
                (
                SELECT SUM(o.price) AS price
                FROM `repair` o 
                WHERE YEAR(o.create_date) = '$year'
                      AND SUBSTR(o.create_date,6,2) = '$month'
                      AND o.car_id = '$car_id'

                UNION 

                SELECT SUM(o.price) AS price
                FROM expenses_truck o 
                WHERE YEAR(o.create_date) = '$year'
                      AND SUBSTR(o.create_date,6,2) = '$month'
                      AND o.car_id = '$car_id'

                ) Q1 ";
        
        $result = \Yii::$app->db->createCommand($sql)->queryOne();
        return $result['price'];
    }
    
    //ดึงรายการค่าซ่อมรถทั้งหมดมาแสดง
    function get_expenses_truck($year = null,$month = null,$car_id = null){
        $sql = "SELECT *
                FROM
                (
                SELECT o.detail,o.price
                FROM `repair` o 
                WHERE YEAR(o.create_date) = '$year'
                      AND SUBSTR(o.create_date,6,2) = '$month'
                      AND o.car_id = '$car_id'

                UNION 

                SELECT o.detail,o.price
                FROM expenses_truck o 
                WHERE YEAR(o.create_date) = '$year'
                      AND SUBSTR(o.create_date,6,2) = '$month'
                      AND o.car_id = '$car_id'

                ) Q1 ";
        
        $result = \Yii::$app->db->createCommand($sql)->queryAll();
        return $result;
    }
    
    //ค่าใช้จ่ายงวดรถ
    function sum_annuities($year = null,$month = null,$car_id = null){
        $sql = "SELECT SUM(a.period_price) AS price
                FROM annuities a 
                WHERE a.car_id = '$car_id'
                        AND YEAR(a.create_date) = '$year'
                    AND SUBSTR(a.create_date,6,2) = '$month' ";
        $result = \Yii::$app->db->createCommand($sql)->queryOne();
        return $result['price'];
    }
    
    //ค่าใช้ต่อประกัน/ภาษี
    function sum_truck_act($year = null,$month = null,$car_id = null){
        $sql = "SELECT SUM(a.act_price) AS price
                FROM truck_act a 
                WHERE a.car_id = '$car_id'
                        AND YEAR(a.create_date) = '$year'
                    AND SUBSTR(a.create_date,6,2) = '$month' ";
        $result = \Yii::$app->db->createCommand($sql)->queryOne();
        return $result['price'];
    }
    
    //ค่าใช้จ่ายรวมพนักงาน
    function sum_salary($year = null,$month = null,$car_id = null){
        $sql = "SELECT SUM(Q1.price) AS price
                FROM
                (
                SELECT 
                        SUM((TRIM(SUBSTR(a.allowance_driver1,7,10)) + TRIM(SUBSTR(a.allowance_driver2,7,10)))) AS price
                FROM assign a 
                WHERE a.car_id = '$car_id'
                        AND YEAR(a.order_date_start) = '$year'
                    AND SUBSTR(a.order_date_start,6,2) = '$month'

                UNION 

                SELECT SUM(d.price) AS price
                FROM driver_income d 
                WHERE d.car_id = '$car_id'
                        AND YEAR(d.create_date) = '$year'
                    AND SUBSTR(d.create_date,6,2) = '$month'

                UNION

                SELECT SUM(s.salary) AS price
                FROM salary s 
                WHERE s.car_id = '$car_id'
                AND YEAR(s.date_salary) = '$year'
                    AND SUBSTR(s.date_salary,6,2) = '$month'
                ) Q1 ";
        $result = \Yii::$app->db->createCommand($sql)->queryOne();
        return $result['price'];
    }
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

