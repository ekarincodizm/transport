<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "assign".
 *
 * @property integer $id
 * @property string $order_id
 * @property string $assign_id
 * @property string $order_date_start
 * @property string $order_date_end
 * @property integer $car_id
 * @property integer $driver1
 * @property integer $driver2
 * @property string $employer
 * @property integer $oil_set
 * @property integer $oil
 * @property double $oil_unit
 * @property double $oil_price
 * @property integer $gas
 * @property double $gas_unit
 * @property double $gas_price
 * @property integer $product_up
 * @property integer $product_down
 * @property string $old_mile
 * @property string $now_mile
 * @property string $distance
 * @property string $distance_collect
 * @property string $avg_oil
 * @property string $compensate
 * @property string $transport_date
 * @property string $cus_start
 * @property string $cus_end
 * @property integer $changwat_start
 * @property integer $changwat_end
 * @property integer $product_type
 * @property integer $weigh
 * @property integer $type_calculus
 * @property string $unit_price
 * @property string $per_times
 * @property string $income
 * @property string $allowance_driver1
 * @property string $allowance_driver2
 * @property string $message
 * @property string $create_date
 *
 * @property OrdersTransport $order
 * @property ProductType $productType
 */
class Assign extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'assign';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['order_date_start', 'order_date_end', 'transport_date', 'create_date'], 'safe'],
            [['car_id', 'driver1', 'driver2', 'oil_set', 'oil', 'gas', 'product_up', 'product_down', 'changwat_start', 'changwat_end', 'product_type', 'weigh', 'type_calculus'], 'integer'],
            [['oil_unit', 'oil_price', 'gas_unit', 'gas_price', 'unit_price', 'per_times', 'income'], 'number'],
            [['order_id', 'compensate'], 'string', 'max' => 10],
            [['assign_id'], 'string', 'max' => 5],
            [['employer', 'cus_start', 'cus_end'], 'string', 'max' => 7],
            [['old_mile', 'now_mile', 'distance', 'avg_oil'], 'string', 'max' => 20],
            [['distance_collect'], 'string', 'max' => 50],
            [['allowance_driver1', 'allowance_driver2'], 'string', 'max' => 15],
            [['message'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'order_id' => 'รหัสใบสั่งงาน',
            'assign_id' => 'รหัสสั่งงาน',
            'order_date_start' => 'วันที่ไป',
            'order_date_end' => 'วันที่สิ้นสุด',
            'car_id' => 'รหัสรถ(คันที่)',
            'driver1' => 'คนขับ1',
            'driver2' => 'คนขับ2',
            'employer' => 'รหัสผู้ว่าจ้าง',
            'oil_set' => 'น้ำมันที่กำหนด',
            'oil' => 'น้ำมันที่เติม',
            'oil_unit' => 'ราคาลิตรละ',
            'oil_price' => 'รวมเงินเติมน้ำมัน',
            'gas' => 'จำนวนก๊าซที่เติม/กก.',
            'gas_unit' => 'กก.ละ',
            'gas_price' => 'รวมเงินเติมก๊าซ',
            'product_up' => 'ค่าขึ้นของ',
            'product_down' => 'ค่าลงของ',
            'old_mile' => 'เลขไมล์เดิม',
            'now_mile' => 'เลขไมล์เที่ยวนี้',
            'distance' => 'ระยะทางเที่ยวนี่',
            'distance_collect' => 'ระยะทางสะสม',
            'avg_oil' => 'ค่าเฉลี่ยน้ำมันต่อลิตร',
            'compensate' => 'ชดเชยน้ำมัน',
            'transport_date' => 'วันที่ขนส่ง',
            'cus_start' => 'ลูกค้าต้นทาง',
            'cus_end' => 'ลูกค้าปลายทาง',
            'changwat_start' => 'ต้นทาง',
            'changwat_end' => 'ปลายทาง',
            'product_type' => 'ประเภทสินค้า',
            'weigh' => 'น้ำหนัก',
            'type_calculus' => '0 = คืดตามน้ำหนัก,1 = คิดตามเที่ยว',
            'unit_price' => 'ราคาในกรณีเลือกแบบคิดตามน้ำหนัก',
            'per_times' => 'กรณีขนส่งต่อเที่ยว',
            'income' => 'รายได้',
            'allowance_driver1' => 'เบี้ยเลี้ยงคนขับ1 ,5 หลักแรกคือรหัสคนขับ',
            'allowance_driver2' => 'เบี้ยเลี้ยงคนขับ2 ,5 หลักแรกคือรหัสคนขับ',
            'message' => 'Message',
            'create_date' => 'วันที่บันทึก',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder() {
        return $this->hasOne(OrdersTransport::className(), ['order_id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductType() {
        return $this->hasOne(ProductType::className(), ['id' => 'product_type']);
    }
    
    //ดึงรายการค่าใช้จ่ายของรถขณะรถวิ่งตามรหัสสั่งงาน
    public function get_expense_truck_in_assignid($assign_id = null) {
        $sql = "SELECT CONCAT(e.detail,' (ทะเบียน ',e.truck_license,')') AS detail,price
            FROM expenses_truck e 
            WHERE e.assign_id = '$assign_id' ";
        $rs = Yii::$app->db->createCommand($sql)->queryAll();
        return $rs;
    }
    
    //ดึงค่าใช้จ่ายรวมของรถขณะรถวิ่งตามรหัสสั่งงาน
    public function sum_expense_truck_in_assignid($assign_id = null) {
        $sql = "SELECT SUM(e.price) AS price
            FROM expenses_truck e 
            WHERE e.assign_id = '$assign_id' ";
        $rs = Yii::$app->db->createCommand($sql)->queryOne();
        return $rs['price'];
    }

}
