<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "outgoings".
 *
 * @property integer $id
 * @property string $order_id
 * @property string $detail
 * @property integer $price
 * @property string $create_date
 */
class Outgoings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'outgoings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price'], 'integer'],
            [['create_date'], 'safe'],
            [['order_id','assign_id'], 'string', 'max' => 10],
            [['detail'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'assign_id' => 'Assign_ID',
            'detail' => 'Detail',
            'price' => 'Price',
            'create_date' => 'Create Date',
        ];
    }
    
     //ดึงรายการค่าใช้จ่ายของรถขณะรถวิ่งตามรหัสสั่งงาน
    public function get_expense_in_assignid($assign_id = null) {
        $sql = "SELECT *
            FROM outgoings o
            WHERE o.assign_id = '$assign_id' ";
        $rs = Yii::$app->db->createCommand($sql)->queryAll();
        return $rs;
    }
    
    //ดึงค่าใช้จ่ายรวมของรถขณะรถวิ่งตามรหัสสั่งงาน
    public function sum_expense_in_assignid($assign_id = null) {
        $sql = "SELECT SUM(o.price) AS price
            FROM outgoings o
            WHERE o.assign_id = '$assign_id' ";
        $rs = Yii::$app->db->createCommand($sql)->queryOne();
        return $rs['price'];
    }
}
