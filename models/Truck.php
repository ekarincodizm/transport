<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "truck".
 *
 * @property integer $id
 * @property string $license_plate
 * @property string $brand
 * @property string $model
 * @property string $color
 * @property string $date_buy
 * @property double $price
 * @property double $down
 * @property double $period_price
 * @property integer $period
 * @property string $date_supply
 * @property integer $type_id
 */
class Truck extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'truck';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['date_buy', 'price', 'down', 'period_price', 'date_supply', 'period', 'type_id', 'license_plate', 'brand', 'model', 'color'], 'required'],
            [['date_buy'], 'safe'],
            [['price', 'down', 'period_price'], 'number'],
            [['date_supply','period'], 'string', 'max' => 2],
            [['date_supply','period'], 'string', 'length' => [2, 2]],
            [['period', 'type_id'], 'integer'],
            [['license_plate'], 'string', 'max' => 100],
            [['brand', 'model'], 'string', 'max' => 255],
            [['color'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'license_plate' => 'เลขทะเบียน',
            'brand' => 'ยี่ห้อ',
            'model' => 'รุ่น',
            'color' => 'สี',
            'date_buy' => 'วันที่ซื้อ',
            'price' => 'ราคา',
            'down' => 'เงินดาวน์',
            'period_price' => 'ค่างวด',
            'period' => 'จำนวนงวด',
            'date_supply' => 'วันที่จ่ายค่างวด',
            'type_id' => 'ประเภท',
        ];
    }

    //ประวัติการวิ่งรถ
    function get_history($id) {
        $truck = new Truck();
        $license = $truck->find()->where(['id' => $id])->one();
        $licenses_plate = $license['license_plate'];
        $sql = "SELECT o.assign_id,o.order_date_start,o.order_date_end,o.car_id,o.employer,o.driver1,o.driver2,SUM(o.income) AS income
                FROM assign o INNER JOIN map_truck m ON o.car_id = m.car_id
                WHERE (m.truck_1 = '$licenses_plate' OR m.truck_2 = '$licenses_plate')
		GROUP BY o.assign_id
                ORDER BY o.id DESC ";
        $result = \Yii::$app->db->createCommand($sql)->queryAll();
        return $result;
    }

    //ประวัติการซ่อมระหว่างขนส่ง
    function get_repair_in_order($lincense_plate = null, $year = null, $month = null) {
        $sql = "(
                    SELECT o.id,o.create_date,o.detail,o.price,'0' AS order_id,'0' AS type
                                    FROM `repair` o 
                                    WHERE o.truck_license = '$lincense_plate' 
                                        AND LEFT(o.create_date,4) = '$year'
                                        AND SUBSTR(o.create_date,6,2) = '$month'
                                    ORDER BY o.id DESC
                    )

                    UNION

                    (
                    SELECT e.id,e.create_date,e.detail,e.price,e.assign_id AS order_id,'1' AS type
                                    FROM expenses_truck e
                                    WHERE e.truck_license = '$lincense_plate' 
                                        AND LEFT(e.create_date,4) = '$year'
                                        AND SUBSTR(e.create_date,6,2) = '$month'
                                    ORDER BY e.id DESC
                    )

                    ORDER BY create_date DESC ";
        $result = \Yii::$app->db->createCommand($sql)->queryAll();
        return $result;
    }

    //ประวัติค่าใช้จ่ายทั้งหมด
    function get_price($lincense_plate = null, $year = null, $month = null) {
        $sql = "(
                    SELECT o.id,o.create_date,o.detail,o.price,'0' AS order_id,'0' AS type
                                    FROM `repair` o 
                                    WHERE o.truck_license = '$lincense_plate' 
                                        AND LEFT(o.create_date,4) = '$year'
                                        AND SUBSTR(o.create_date,6,2) = '$month'
                                    ORDER BY o.id DESC
                    )

                    UNION

                    (
                    SELECT e.id,e.create_date,e.detail,e.price,e.assign_id AS order_id,'1' AS type
                                    FROM expenses_truck e
                                    WHERE e.truck_license = '$lincense_plate' 
                                        AND LEFT(e.create_date,4) = '$year'
                                        AND SUBSTR(e.create_date,6,2) = '$month'
                                    ORDER BY e.id DESC
                    )

                    UNION

                    (
                    SELECT e.id,e.create_date,'ค่าต่อทะเบียน/พรบ./ภาษีประจำปี' AS detail,e.act_price AS price,'0' AS order_id,'0' AS type
                                    FROM truck_act e
                                    WHERE e.license_plate = '$lincense_plate' 
                                        AND LEFT(e.create_date,4) = '$year'
                                        AND SUBSTR(e.create_date,6,2) = '$month'
                                    ORDER BY e.id DESC
                    )
                    
                    UNION 

                    (
                        SELECT e.id,e.create_date,CONCAT('จ่ายค่างวดรถ งวดวันที่ ',e.`day`,'/',e.`month`,'/',e.`year`) AS detail,e.period_price AS price,'0' AS order_id,'0' AS type
                        FROM annuities e
                        WHERE e.license_plate = '$lincense_plate' 
                             AND LEFT(e.create_date,4) = '$year'
                             AND SUBSTR(e.create_date,6,2) = '$month'
                        ORDER BY e.id DESC
                    )

                    UNION 

                    (
                        SELECT o.id,o.order_date_start AS create_date,'เติมน้ำมัน ' AS detail,o.oil_price AS price,o.assign_id AS order_id,'0' AS type
                        FROM assign o INNER JOIN map_truck t ON o.car_id = t.car_id
                        WHERE t.truck_1 = '$lincense_plate' 
                            AND o.oil_price != ''
                            AND LEFT(o.order_date_start,4) = '$year'
                            AND SUBSTR(o.order_date_start,6,2) = '$month'
                        ORDER BY o.id DESC
                    )

                    UNION 

                    (
                        SELECT o.id,o.order_date_start AS create_date,'เติมแก๊ส ' AS detail,o.gas_price AS price,o.assign_id AS order_id,'0' AS type
                        FROM assign o INNER JOIN map_truck t ON o.car_id = t.car_id
                        WHERE t.truck_1 = '$lincense_plate' 
                            AND o.gas_price != ''
                            AND LEFT(o.order_date_start,4) = '$year'
                            AND SUBSTR(o.order_date_start,6,2) = '$month'
                        ORDER BY o.id DESC
                    )
                    
                UNION 

                    (
                        SELECT o.id,o.create_date,'เปลี่ยนน้ำมันเครื่อง ' AS detail,o.price,'0'  AS order_id,'0' AS type
                        FROM engine_oil o 
                        WHERE o.license_plate = '$lincense_plate' 
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
