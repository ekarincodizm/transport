<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transport_suite".
 *
 * @property integer $id
 * @property integer $driver_id
 * @property integer $tractor_id
 * @property integer $truck_id
 * @property string $alias
 * @property integer $flag
 */
class TransportSuite extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transport_suite';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['driver_id', 'tractor_id', 'truck_id', 'flag'], 'integer'],
            [['alias'], 'string', 'max' => 5]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'driver_id' => 'คนขับรถ',
            'tractor_id' => 'หัวลากรถ',
            'truck_id' => 'ตัวบรรทุก',
            'alias' => 'ชื่อย่อชุดขนส่ง',
            'flag' => 'สถานะชุดบรรทุก',
        ];
    }
}
