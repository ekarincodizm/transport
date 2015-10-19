<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "driver".
 *
 * @property integer $id
 * @property string $name
 * @property string $lname
 * @property string $card_id
 * @property string $address
 * @property string $tel1
 * @property string $tel2
 * @property string $driver_license_id
 * @property string $driver_license_expire
 * @property string $create_date
 * @property string $images
 */
class Driver extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'driver';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['driver_license_expire','name','lname','card_id','address','tel1','driver_license_id'],'required'],
            [['driver_license_expire', 'create_date','d_update'], 'string'],
            [['name', 'lname', 'images'], 'string', 'max' => 100],
            [['card_id'], 'string', 'max' => 13],
            [['address'], 'string', 'max' => 255],
            [['tel1', 'tel2', 'driver_license_id'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ชื่อ',
            'lname' => 'นามสกุล',
            'card_id' => 'บัตรประชาชน',
            'address' => 'ที่อยู่',
            'tel1' => 'เบอร์โทร',
            'tel2' => 'เบอร์โทรสำรอง',
            'driver_license_id' => 'เลขใบขับขี่',
            'driver_license_expire' => 'หมดอายุ',
            'create_date' => 'วันที่บันทึก',
            'images' => 'รูปภาพ',
        ];
    }
}
