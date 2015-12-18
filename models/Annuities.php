<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "annuities".
 *
 * @property integer $id
 * @property string $license_plate
 * @property integer $period
 * @property string $month
 * @property string $year
 * @property string $create_date
 */
class Annuities extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'annuities';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['period'], 'integer'],
            [['create_date'], 'safe'],
            [['car_id'],'integer'],
            [['license_plate'], 'string', 'max' => 10],
            [['month', 'year'], 'string', 'max' => 2]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'license_plate' => 'ทะเบียนรถ',
            'period' => 'งวดที่',
            'month' => 'ประจำเดือน',
            'year' => 'ประจำปี',
            'create_date' => 'วันที่บันทึก',
        ];
    }
    
    function count_over(){
        $sql = "
                SELECT COUNT(*) AS TOTAL
                FROM
                (
                SELECT a.license_plate,
                MAX(CONCAT(`year`,`month`,t.date_supply)) AS last_day,
                MAX(CONCAT(`year`,`month`)) AS last_month,
                t.date_supply,
                t.`status`
                FROM annuities a INNER JOIN truck t 
                ON a.license_plate = t.license_plate
                GROUP BY a.license_plate
                ) Q1 

                WHERE CONCAT(YEAR(NOW()),MONTH(NOW()),DAY(NOW())) > Q1.last_day
                AND CONCAT(YEAR(NOW()),MONTH(NOW())) != Q1.last_month

                AND DATEDIFF(CONCAT(YEAR(NOW()),MONTH(NOW()),Q1.date_supply),DATE(NOW())) < (SELECT truck_period FROM notifications)
                AND Q1.`status` = '0'";
        $rs = Yii::$app->db->createCommand($sql)->queryOne();
        return $rs['TOTAL'];
    }
    
    function list_over(){
        $sql = "        
            SELECT *,CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-',Q1.date_supply) AS checkdate,Q1.last_day,
                    DATEDIFF(CONCAT(YEAR(NOW()),MONTH(NOW()),Q1.date_supply),DATE(NOW())) AS over_day
            FROM
            (
            SELECT t.id,a.license_plate,
            MAX(CONCAT(`year`,`month`,t.date_supply)) AS last_day,
            MAX(CONCAT(`year`,'-',`month`,'-',t.date_supply)) AS last_period,
            MAX(CONCAT(`year`,`month`)) AS last_month,
            t.date_supply,
            t.`status`
            FROM annuities a INNER JOIN truck t 
            ON a.license_plate = t.license_plate
            GROUP BY a.license_plate
            ) Q1 

            WHERE CONCAT(YEAR(NOW()),MONTH(NOW()),DAY(NOW())) > Q1.last_day
            AND CONCAT(YEAR(NOW()),MONTH(NOW())) != Q1.last_month

            AND DATEDIFF(CONCAT(YEAR(NOW()),MONTH(NOW()),Q1.date_supply),DATE(NOW())) < (SELECT truck_period FROM notifications)
            AND Q1.`status` = '0' ";
        $rs = Yii::$app->db->createCommand($sql)->queryAll();
        return $rs;
    }
}
