<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "engine_oil".
 *
 * @property integer $id
 * @property string $date_start
 * @property string $date_end
 * @property string $license_plate
 * @property integer $car_id
 * @property integer $price
 * @property string $create_date
 */
class EngineOil extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'engine_oil';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_date'], 'safe'],
            [['car_id', 'price','now_mile','next_mile'], 'integer'],
            [['license_plate'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'now_mile' => 'เลขไมล์ ณ วันที่มาเปลี่ยน',
            'next_mile' => 'เลขไมล์ครั้งต่อไป',
            'license_plate' => 'ทะเบียนรถ',
            'car_id' => 'รถคันที่',
            'price' => 'ราคา',
            'create_date' => 'วันที่บันทึก',
        ];
    }
    
    public function notify_engine(){
        $sql = "SELECT COUNT(*) AS TOTAL
                    FROM truck tk

                    INNER JOIN 
                    (
                    SELECT t.license_plate,MAX(t.create_date) AS date_service
                    FROM engine_oil t 
                    GROUP BY t.license_plate
                    ) Q1 

                    ON tk.license_plate = Q1.license_plate

                    WHERE DATEDIFF(Q1.date_service,DATE(NOW())) < (SELECT engine_oil FROM notifications) ";
        
       $result = Yii::$app->db->createCommand($sql)->queryOne();
       return $result['TOTAL'];
    }
}
