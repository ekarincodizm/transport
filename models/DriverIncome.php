<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "driver_income".
 *
 * @property integer $id
 * @property string $employee
 * @property string $detail
 * @property integer $price
 * @property string $year
 * @property string $month
 * @property string $create_date
 */
class DriverIncome extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'driver_income';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['price'], 'integer'],
            [['create_date'], 'safe'],
            [['employee'], 'string', 'max' => 5],
            [['detail'], 'string', 'max' => 255],
            [['year'], 'string', 'max' => 4],
            [['month'], 'string', 'max' => 2]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'employee' => 'รหัสพนักงาน',
            'detail' => 'รายการ',
            'price' => 'ราคา',
            'year' => 'ปี',
            'month' => 'เดือน',
            'create_date' => 'วันที่บันทึก',
        ];
    }

    //ข้อมูลรายรับของพนักงาน
    function income($employee = null, $year = null, $month = null) {
        $query = "SELECT a.transport_date,'เบี้ยเลี้ยง' AS detail,
                    IF(LEFT(a.allowance_driver1,5) = '$employee',trim(SUBSTR(a.allowance_driver1,7,15)),trim(SUBSTR(a.allowance_driver2,7,15))) AS price
                    FROM assign a 
                    WHERE (LEFT(a.allowance_driver1,5) = '$employee' OR LEFT(a.allowance_driver2,5) = '$employee')
                    AND LEFT(a.transport_date,4) = '$year'
                    AND SUBSTR(a.transport_date,6,2) = '$month'

                    UNION

                    SELECT d.create_date AS transport_date,detail,price
                    FROM driver_income d 
                    WHERE d.month = '$month' AND d.year = '$year' 
                    AND d.employee = '$employee' ";
        $result = Yii::$app->db->createCommand($query)->queryAll();
        return $result;
    }

}
