<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders_transport_affiliated".
 *
 * @property integer $id
 * @property string $order_id
 * @property string $order_date_start
 * @property string $order_date_end
 * @property integer $truck1
 * @property integer $truck2
 * @property integer $driver1
 * @property integer $driver2
 * @property string $employer
 * @property integer $oil_set
 * @property integer $oil
 * @property string $create_date
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
 * @property string $message
 * @property integer $delete_flag
 */
class OrdersTransportAffiliated extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders_transport_affiliated';
    }

    /**
     * @inheritdoc
     */
        public function rules() {
        return [
            [['order_date_start', 'order_date_end', 'truck1', 'driver1','employer','company_id'], 'required'],
            [['order_date_start', 'order_date_end', 'create_date'], 'safe'],
            [['truck1', 'truck2','price_employer','price_affiliated','income_total'], 'integer'],
            [['driver1', 'driver2'],'string','max' => '100'],
            [['order_id','company_id'], 'string', 'max' => 10],
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
            'company_id' => 'บริษัทรถร่วม',
            'truck1' => 'รหัสรถ1(หัวลาก,หรือรถไม่มีพ่วง)',
            'truck2' => 'รหัสรถ2(พ่วง)',
            'driver1' => 'คนขับ1',
            'driver2' => 'คนขับ2',
            'create_date' => 'วันที่บันทึกข้อมูล',
        ];
    }

}
