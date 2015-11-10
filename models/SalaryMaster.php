<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "salary_master".
 *
 * @property integer $id
 * @property string $employee
 * @property integer $salary
 * @property string $update_salary
 * @property integer $active
 */
class SalaryMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'salary_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['salary', 'active'], 'integer'],
            [['update_salary'], 'safe'],
            [['employee'], 'string', 'max' => 5]
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
            'salary' => 'เงินเดือน',
            'update_salary' => 'วันที่ขึ้นเงินเดือน',
            'active' => ' 0 = ไม่ใช้,1 = ใช้',
        ];
    }
}
