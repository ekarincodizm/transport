<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "salary".
 *
 * @property integer $id
 * @property string $employee
 * @property integer $salary
 * @property string $year
 * @property string $month
 * @property string $date_salary
 */
class Salary extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'salary';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['salary'], 'integer'],
            [['date_salary'], 'safe'],
            [['employee'], 'string', 'max' => 5],
            [['year'], 'string', 'max' => 4],
            [['month'], 'string', 'max' => 2]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'employee' => 'รหัสพนักงาน/คนขับรถ',
            'salary' => 'เงินเดือน',
            'year' => 'ประจำปี',
            'month' => 'ประจำเดือน',
            'date_salary' => 'วันที่จ่าย',
        ];
    }
    
    function getsalary_one($employee = null){
        $query = "SELECT s.*,m.month_th
                  FROM salary s INNER JOIN month m ON s.month = m.id 
                  WHERE s.employee = '$employee'
                  ORDER BY s.year,s.month DESC";
        $result = \Yii::$app->db->createCommand($query)->queryAll();
        return $result;
    }
}
