<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property integer $id
 * @property string $company
 * @property string $address
 * @property string $tel
 * @property string $agent
 * @property string $create_date
 */
class Customer extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'customer';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['company', 'address', 'tel', 'agent', 'tax_number'], 'required'],
            [['cus_id'], 'string', 'max' => 7],
            [['create_date'], 'safe'],
            [['company', 'address'], 'string', 'max' => 255],
            [['tel'], 'string', 'max' => 20],
            [['tax_number'], 'string', 'max' => 50],
            [['agent'], 'string', 'max' => 100],
            [['detail'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'cus_id' => 'รหัส',
            'tax_number' => 'เลขที่ผู้เสียภาษี',
            'company' => 'บริษัท',
            'address' => 'ที่อยู่บริษัท',
            'tel' => 'โทรศัทพ์',
            'agent' => 'ผู้ติดต่อ',
            'detail' => 'รายละเอียด',
            'create_date' => 'วันที่บันทึก',
        ];
    }

}
