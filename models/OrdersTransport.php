<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders_transport".
 *
 * @property integer $id
 * @property string $order_id
 * @property string $order_date_start
 * @property string $order_date_end
 * @property integer $truck1
 * @property integer $truck2
 * @property integer $driver1
 * @property integer $driver2
 * @property string $create_date
 */
class OrdersTransport extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'orders_transport';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['order_date_start', 'order_date_end', 'truck1', 'driver1','employer'], 'required'],
            [['order_date_start', 'order_date_end', 'create_date'], 'safe'],
            [['truck1', 'truck2', 'driver1', 'driver2', 'oil_set'], 'integer'],
            [['order_id'], 'string', 'max' => 10],
            [['order_id'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'order_id' => 'รหัสใบปฏิบัติงาน',
            'employer' => 'ผู้ว่าจ้าง',
            'order_date_start' => 'วันที่ไป',
            'order_date_end' => 'วันที่กลับ',
            'truck1' => 'รหัสรถ1(หัวลาก,หรือรถไม่มีพ่วง)',
            'truck2' => 'รหัสรถ2(พ่วง)',
            'driver1' => 'คนขับ1',
            'driver2' => 'คนขับ2',
            'create_date' => 'วันที่บันทึกข้อมูล',
        ];
    }

    function get_old_mile($id = null,$truck1 = null) {
        $query = "SELECT MAX(id),a.old_mile,a.now_mile
                        FROM assign a INNER JOIN map_truck m ON a.car_id = m.car_id
                        WHERE m.truck_1 = '$truck1' AND a.id != '$id' ";
        $rs = Yii::$app->db->createCommand($query)->queryOne();
        if (!empty($rs)) {
            return $rs['now_mile'];
        } else {
            return 0;
        }
    }

}
