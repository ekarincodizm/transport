<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "affiliated_truck".
 *
 * @property integer $id
 * @property string $company_id
 * @property string $license_plate
 * @property string $brand
 * @property string $model
 * @property string $color
 * @property integer $type_id
 *
 * @property Affiliated $company
 */
class AffiliatedTruck extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'affiliated_truck';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id','license_plate','brand','color','model'],'required'],
            [['type_id'], 'integer'],
            [['company_id'], 'string', 'max' => 10],
            [['license_plate'], 'string', 'max' => 20],
            [['brand', 'model'], 'string', 'max' => 255],
            [['color'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'รหัสบริษัทเจ้าของรถ',
            'license_plate' => 'ทะเบียน',
            'brand' => 'ยี่ห้อ',
            'model' => 'รุ่น',
            'color' => 'สี',
            'type_id' => 'ประเภท',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Affiliated::className(), ['company_id' => 'company_id']);
    }
}
