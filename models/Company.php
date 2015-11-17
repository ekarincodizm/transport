<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property integer $id
 * @property string $CompanyName
 * @property string $Address
 * @property string $contact
 * @property string $Taxation_Number
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CompanyName', 'Address', 'contact'], 'string', 'max' => 150],
            [['Taxation_Number'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'CompanyName' => 'ชื่อบริษัท',
            'Address' => 'ที่อยู่บริษัท',
            'contact' => 'ที่ติดต่อ',
            'Taxation_Number' => 'เลขผู้เสียภาษีอากร',
        ];
    }
}
