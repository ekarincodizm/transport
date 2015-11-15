<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "driver_expenses".
 *
 * @property integer $id
 * @property string $employee
 * @property string $detail
 * @property integer $price
 * @property string $year
 * @property string $month
 * @property string $create_date
 */
class DriverExpenses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'driver_expenses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
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
    public function attributeLabels()
    {
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
}
