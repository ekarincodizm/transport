<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "truck".
 *
 * @property integer $id
 * @property string $license_plate
 * @property string $brand
 * @property string $model
 * @property string $color
 * @property string $date_buy
 * @property double $price
 * @property double $down
 * @property double $period_price
 * @property integer $period
 * @property string $date_supply
 * @property integer $type_id
 */
class Truck extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'truck';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['date_buy', 'price', 'down', 'period_price', 'date_supply', 'period', 'type_id', 'license_plate', 'brand', 'model', 'color'], 'required'],
            [['date_buy'], 'safe'],
            [['price', 'down', 'period_price'], 'number'],
            [['date_supply'], 'string', 'max' => 2],
            [['period', 'type_id'], 'integer'],
            [['license_plate'], 'string', 'max' => 20],
            [['brand', 'model'], 'string', 'max' => 255],
            [['color'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'license_plate' => 'เลขทะเบียน',
            'brand' => 'ยี่ห้อ',
            'model' => 'รุ่น',
            'color' => 'สี',
            'date_buy' => 'วันที่ซื้อ',
            'price' => 'ราคา',
            'down' => 'เงิาดาวน์',
            'period_price' => 'ค่างวด',
            'period' => 'จำนวนงวด',
            'date_supply' => 'วันที่จ่ายค่างวด',
            'type_id' => 'ประเภท',
        ];
    }

}
