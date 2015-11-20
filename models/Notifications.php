<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notifications".
 *
 * @property integer $id
 * @property integer $driver_license
 * @property integer $truck_act
 * @property integer $truck_period
 */
class Notifications extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notifications';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['driver_license','truck_act','truck_period'],'required'],
            [['driver_license', 'truck_act', 'truck_period'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'driver_license' => 'แจ้งเตือนใบขับขี่(วัน)',
            'truck_act' => 'แจ้งเตือน พรบ./ภาษี(วัน)',
            'truck_period' => 'แจ้งเตือนค่างวด(วัน)',
        ];
    }
}
