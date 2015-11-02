<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "expenses_truck".
 *
 * @property integer $id
 * @property string $truck_license
 * @property string $order_id
 * @property string $detail
 * @property double $price
 * @property string $create_date
 */
class ExpensesTruck extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'expenses_truck';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price'], 'number'],
            [['create_date'], 'safe'],
            [['truck_license'], 'string', 'max' => 20],
            [['order_id'], 'string', 'max' => 10],
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
            'truck_license' => 'ทะเบียนรถ',
            'order_id' => 'รหัสใบปฏิบัติงาน',
            'detail' => 'รายการ',
            'price' => 'ราคา',
            'create_date' => 'วันที่บันทึก',
        ];
    }
}
