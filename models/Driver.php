<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "driver".
 *
 * @property integer $id
 * @property string $name
 * @property string $lname
 * @property string $card_id
 * @property string $address
 * @property string $tel1
 * @property string $tel2
 * @property string $driver_license_id
 * @property string $driver_license_expire
 * @property string $create_date
 * @property string $images
 */
class Driver extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'driver';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['driver_license_expire', 'name', 'lname', 'card_id', 'address', 'tel1', 'driver_license_id', 'birth'], 'required'],
            [['driver_license_expire', 'create_date', 'd_update', 'driver_id', 'birth'], 'string'],
            [['name', 'lname', 'images'], 'string', 'max' => 100],
            [['card_id', 'tel1', 'tel2', 'driver_license_id'], 'number'],
            [['card_id'], 'string', 'length' => [13, 13]],
            [['address'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'driver_id' => 'รหัส',
            'name' => 'ชื่อ',
            'lname' => 'นามสกุล',
            'card_id' => 'บัตรประชาชน',
            'birth' => 'วันเกิด',
            'address' => 'ที่อยู่',
            'tel1' => 'เบอร์โทร',
            'tel2' => 'เบอร์โทรสำรอง',
            'driver_license_id' => 'เลขใบขับขี่',
            'driver_license_expire' => 'หมดอายุ',
            'create_date' => 'วันที่บันทึก',
            'images' => 'รูปภาพ',
        ];
    }

    function history($driver_id = null) {
        $query = "SELECT o.id,o.order_id,transport_date,a.order_id,a.assign_id,a.cus_start,a.cus_end,a.changwat_start,a.changwat_end,
                    IF(LEFT(a.allowance_driver1,5) = '$driver_id',TRIM(SUBSTR(a.allowance_driver1,7,10)),TRIM(SUBSTR(a.allowance_driver2,7,10))) AS allowance_driver
                    FROM assign a INNER JOIN orders_transport o ON a.order_id = o.order_id
                    WHERE LEFT(a.allowance_driver1,5) = '$driver_id' OR LEFT(a.allowance_driver2,5) = '$driver_id' ";

        $result = Yii::$app->db->createCommand($query)->queryAll();
        return $result;
    }

}
