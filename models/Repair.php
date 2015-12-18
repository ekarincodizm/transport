<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "repair".
 *
 * @property integer $id
 * @property string $truck_license
 * @property string $detail
 * @property integer $price
 * @property string $create_date
 */
class Repair extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'repair';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['detail','price','create_date'],'required'],
            [['detail'], 'string'],
            [['price','car_id'], 'integer'],
            [['create_date'], 'safe'],
            [['truck_license'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'truck_license' => 'ทะเบียนรถ',
            'detail' => 'รายละเอียดการซ่อม',
            'price' => 'จำนวนเงิน',
            'create_date' => 'วันที่',
            'car_id' => 'คันที่',
        ];
    }

}
