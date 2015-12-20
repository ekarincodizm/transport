<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "map_driver".
 *
 * @property integer $id
 * @property string $driver
 * @property integer $car_id
 * @property integer $active
 * @property string $create_date
 */
class MapDriver extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'map_driver';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['car_id', 'active'], 'integer'],
            [['create_date'], 'safe'],
            [['driver'], 'string', 'max' => 5]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'driver' => 'รหัสคนขับ',
            'car_id' => 'รถคันที่',
            'active' => '0 = ไม่เลือก ,1 = เลือก',
            'create_date' => 'วันที่บันทึก',
        ];
    }

    public function get_car_driver($driver_id = null) {
        $query = "SELECT d.*,t.truck_1,t.truck_2
                  FROM map_driver d INNER JOIN map_truck t ON d.car_id = t.car_id
                  WHERE d.driver = '$driver_id' AND d.active = '1'";
        $result = Yii::$app->db->createCommand($query)->queryOne();
        if (!empty($result)) {
            $val = "ขับคันที่ " . $result['car_id'] . ' ทะเบียน (' . $result['truck_1'] . ') - (' . $result['truck_2'] . ')';
        } else {
            $val = "ไม่มีรถประจำ";
        }
        return $val;
    }

    function get_driver($driver_id = null) {
        $driver = new Driver();
        $rs = $driver->find()->where(['driver_id' => $driver_id])->one();
        return $rs['name'] . ' ' . $rs['lname'];
    }

}
