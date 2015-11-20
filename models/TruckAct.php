<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "truck_act".
 *
 * @property integer $id
 * @property string $license_plate
 * @property string $act_start
 * @property string $act_end
 * @property string $create_date
 */
class TruckAct extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'truck_act';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['act_start', 'act_end'], 'required'],
            [['act_start', 'act_end', 'create_date'], 'safe'],
            [['license_plate'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'license_plate' => 'ทะเบียนรถ',
            'act_start' => 'วันที่เริ่ม',
            'act_end' => 'วันที่ครบกำหนด',
            'create_date' => 'วันที่ทำรายการ',
        ];
    }

    public function notification_act() {
        $query = "SELECT COUNT(*) AS TOTAL
                    FROM truck tk

                    INNER JOIN 
                    (
                    SELECT t.license_plate,MAX(t.act_end) AS act_end
                    FROM truck_act t 
                    GROUP BY t.license_plate
                    ) Q1 

                    ON tk.license_plate = Q1.license_plate

                    WHERE 
DATEDIFF(Q1.act_end,DATE(NOW())) < (SELECT truck_act FROM notifications) ";
        $rs = Yii::$app->db->createCommand($query)
                ->queryOne();
        return $rs['TOTAL'];
    }

    public function list_notification_act() {
        $query = "SELECT tk.id,Q1.*,DATEDIFF(Q1.act_end,DATE(NOW())) AS OVER_DAY
                    FROM truck tk

                    INNER JOIN 
                    (
                    SELECT t.license_plate,MAX(t.act_end) AS act_end
                    FROM truck_act t 
                    GROUP BY t.license_plate
                    ) Q1 

                    ON tk.license_plate = Q1.license_plate

                    WHERE 
                    DATEDIFF(Q1.act_end,DATE(NOW())) < (SELECT truck_act FROM notifications) ";
        $rs = Yii::$app->db->createCommand($query)
                ->queryAll();
        return $rs;
    }

}
