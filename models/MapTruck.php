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
                (SELECT m.truck_1 FROM map_truck m WHERE m.status != '1') ";
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        return $result;
    }

    //ดึงข้อมูลประเภทพ่วงที่ยังไม่จับคู่
    function get_truck_type2_noselect() {
        $sql = "SELECT *
                FROM truck t 
                WHERE t.type_id = '2' AND t.license_plate NOT IN
                (SELECT m.truck_2 FROM map_truck m WHERE m.status != '1') ";
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

}
