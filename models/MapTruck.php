<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "map_truck".
 *
 * @property integer $car_id
 * @property string $truck_1
 * @property string $truck_2
 * @property string $create_date
 */
class MapTruck extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'map_truck';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['truck_1', 'truck_2'], 'required'],
            [['create_date'], 'safe'],
            [['truck_1', 'truck_2'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'car_id' => 'รถคันที่',
            'truck_1' => 'ทะเบียนหัวลาก',
            'truck_2' => 'ทะเบียนพ่วง',
            'create_date' => 'วันที่บันทึก',
        ];
    }

    //ดึงข้อมูลประเภทหัวลากที่ยังไม่จับคู่
    function get_truck_type1_noselect() {
        $sql = "SELECT *
                FROM truck t 
                WHERE t.type_id = '1' AND t.license_plate NOT IN
                (SELECT m.truck_1 FROM map_truck m WHERE m.status != '1') 
                AND t.status != '1' AND delete_flag = '0' ";
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        return $result;
    }

    //ดึงข้อมูลประเภทพ่วงที่ยังไม่จับคู่
    function get_truck_type2_noselect() {
        $sql = "SELECT *
                FROM truck t 
                WHERE t.type_id = '2' AND t.license_plate NOT IN
                (SELECT m.truck_2 FROM map_truck m WHERE m.status != '1') 
                AND t.status != '1' AND delete_flag = '0' ";
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        return $result;
    }

    //ดุงข้อมูลรถที่ต่อแล้วมาแสดง
    function get_map_truck() {
        $sql = "SELECT m.*,d.driver,d.`name`,d.lname
                FROM map_truck m LEFT JOIN 
                    (SELECT car_id,driver,d.`name`,d.lname
                        FROM map_driver m INNER JOIN driver d ON m.driver = d.driver_id
                        WHERE m.active = '1') d
                ON m.car_id = d.car_id
                WHERE m.status = '0'  ";
        /*
         * Comment 
         * active คือ เอาคนขันคนปัจจุบัน
         * status คือ เอารถที่ยังใช้งานได้อยู่
         */
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        return $result;
    }

    //ประวัติค่าใช้จ่ายทั้งหมด
    function get_price($car_id = null, $year = null, $month = null) {
        //ข้อมูลการซ่อมของทะเบียนรถคันที่ 1
        $sql = "(
                    SELECT o.id,o.create_date,CONCAT(o.detail,' (ทะเบียน ',t.truck_1,')') AS detail,o.price,'0' AS order_id,'0' AS type
                                    FROM `repair` o INNER JOIN map_truck t ON o.truck_license = t.truck_1
                                    WHERE t.car_id = '$car_id' 
                                        AND LEFT(o.create_date,4) = '$year'
                                        AND SUBSTR(o.create_date,6,2) = '$month'
                                    ORDER BY o.id DESC
                    )
                    
                    UNION ";
        //ข้อมูลการซ่อมของทะเบียนรถคันที่ 2            
        $sql .= "(
                    SELECT o.id,o.create_date,CONCAT(o.detail,' (ทะเบียน ',t.truck_2,')') AS detail,o.price,'0' AS order_id,'0' AS type
                                    FROM `repair` o INNER JOIN map_truck t ON o.truck_license = t.truck_2
                                    WHERE t.car_id = '$car_id' 
                                        AND LEFT(o.create_date,4) = '$year'
                                        AND SUBSTR(o.create_date,6,2) = '$month'
                                    ORDER BY o.id DESC
                    )

                    UNION ";
        //ข้อมูลการซ่อมระหว่างรถวิ่งคันที่ 1  
        $sql .= "(
                    SELECT e.id,e.create_date,CONCAT(e.detail,' (ทะเบียน ',e.truck_license,')') AS detail,e.price,e.assign_id AS order_id,'1' AS type
                                    FROM expenses_truck e INNER JOIN map_truck t ON e.truck_license = t.truck_1 
                                    WHERE t.car_id = '$car_id' 
                                        AND LEFT(e.create_date,4) = '$year'
                                        AND SUBSTR(e.create_date,6,2) = '$month'
                                    ORDER BY e.id DESC
                    )

                    UNION ";
        //ข้อมูลการซ่อมระหว่างรถวิ่งคันที่ 2
        $sql .= "(
                    SELECT e.id,e.create_date,CONCAT(e.detail,' (ทะเบียน ',e.truck_license,')') AS detail,e.price,e.assign_id AS order_id,'1' AS type
                                    FROM expenses_truck e INNER JOIN map_truck t ON e.truck_license = t.truck_2
                                    WHERE t.car_id = '$car_id' 
                                        AND LEFT(e.create_date,4) = '$year'
                                        AND SUBSTR(e.create_date,6,2) = '$month'
                                    ORDER BY e.id DESC
                    )

                    UNION ";
        //ข้อมูลการต่อภาษี รถคันที่ 1
        $sql .= "(
                    SELECT e.id,e.create_date,CONCAT('ค่าต่อทะเบียน/พรบ./ภาษีประจำปี (ทะเบียน ',t.truck_1,')') AS detail,e.act_price AS price,'0' AS order_id,'0' AS type
                                    FROM truck_act e INNER JOIN map_truck t ON e.license_plate = t.truck_1
                                    WHERE t.car_id = '$car_id' 
                                        AND LEFT(e.create_date,4) = '$year'
                                        AND SUBSTR(e.create_date,6,2) = '$month'
                                    ORDER BY e.id DESC
                    )
                    
                    UNION ";
        //ข้อมูลการต่อภาษี รถคันที่ 2
        $sql .= "(
                    SELECT e.id,e.create_date,CONCAT('ค่าต่อทะเบียน/พรบ./ภาษีประจำปี (ทะเบียน ',t.truck_2,')') AS detail,e.act_price AS price,'0' AS order_id,'0' AS type
                                    FROM truck_act e INNER JOIN map_truck t ON e.license_plate = t.truck_2
                                    WHERE t.car_id = '$car_id' 
                                        AND LEFT(e.create_date,4) = '$year'
                                        AND SUBSTR(e.create_date,6,2) = '$month'
                                    ORDER BY e.id DESC
                    )
                    
                    UNION ";
        //ข้อมูลค่างวดรถคัน 1
        $sql .= "(
                    SELECT e.id,e.create_date,
                            CONCAT('จ่ายค่างวดรถ งวดวันที่ ',e.`day`,'/',e.`month`,'/',e.`year`,' (ทะเบียน',m.truck_1,')') AS detail,
                            e.period_price AS price,
                            '0' AS order_id,
                            '0' AS type
                    FROM annuities e INNER JOIN map_truck m ON e.license_plate = m.truck_1
                    WHERE m.car_id = '$car_id'
                    AND LEFT(e.create_date,4) = '$year'
                    AND SUBSTR(e.create_date,6,2) = '$month'
                    ORDER BY e.id DESC
                )

                UNION ";
        //ข้อมูลค่างวดรถคัน 2
        $sql .= "(
                    SELECT e.id,e.create_date,
                            CONCAT('จ่ายค่างวดรถ งวดวันที่ ',e.`day`,'/',e.`month`,'/',e.`year`,' (ทะเบียน',m.truck_2,')') AS detail,
                            e.period_price AS price,
                            '0' AS order_id,
                            '0' AS type
                    FROM annuities e INNER JOIN map_truck m ON e.license_plate = m.truck_2
                    WHERE m.car_id = '$car_id'
                    AND LEFT(e.create_date,4) = '$year'
                    AND SUBSTR(e.create_date,6,2) = '$month'
                    ORDER BY e.id DESC
                )

                UNION ";

        $sql .= "
                (
                    SELECT o.id,o.order_date_start AS create_date,CONCAT('เติมน้ำมัน (ทะเบียน',t.truck_1,')') AS detail,o.oil_price AS price,o.assign_id AS order_id,'0' AS type
                    FROM assign o INNER JOIN map_truck t ON o.car_id = t.car_id
                    WHERE t.car_id = '$car_id'
                        AND o.oil_price != ''
                        AND LEFT(o.order_date_start,4) = '$year'
                        AND SUBSTR(o.order_date_start,6,2) = '$month'
                    ORDER BY o.id DESC
                )

                UNION 

                (
                    SELECT o.id,o.order_date_start AS create_date,CONCAT('เติมแก๊ส (ทะเบียน',t.truck_1,')') AS detail,o.gas_price AS price,o.assign_id AS order_id,'0' AS type
                    FROM assign o INNER JOIN map_truck t ON o.car_id = t.car_id
                    WHERE t.car_id = '$car_id'
                        AND o.gas_price != ''
                        AND LEFT(o.order_date_start,4) = '$year'
                        AND SUBSTR(o.order_date_start,6,2) = '$month'
                    ORDER BY o.id DESC
                )
                
                    UNION 

                    (
                     SELECT o.id,o.create_date AS create_date,CONCAT('เปลี่ยนน้ำมันเครื่อง (ทะเบียน' ,o.license_plate,')') AS detail,o.price AS price,'0' AS order_id,'0' AS type
                                        FROM  engine_oil o INNER JOIN map_truck t ON o.car_id = t.car_id
                                        WHERE t.car_id = '$car_id'
                                            AND o.price != ''
                                            AND LEFT(o.create_date,4) = '$year'
                                            AND SUBSTR(o.create_date,6,2) = '$month'
                                        ORDER BY o.id DESC
                    )

                    ORDER BY create_date ASC ";
        $result = \Yii::$app->db->createCommand($sql)->queryAll();
        return $result;
    }

}
