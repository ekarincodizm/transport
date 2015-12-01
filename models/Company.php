<?php

namespace app\models;

use Yii;
use \yii\web\UploadedFile;

/**
 * This is the model class for table "company".
 *
 * @property integer $id
 * @property string $CompanyName
 * @property string $Address
 * @property string $contact
 * @property string $Taxation_Number
 */
class Company extends \yii\db\ActiveRecord {

    public $upload_foler = 'uploads/logo';

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['companyname', 'address', 'contact', 'taxation_number', 'ceo'], 'required'],
            [['companyname', 'address', 'contact'], 'string', 'max' => 150],
            [['ceo'], 'string', 'max' => 100],
            [['taxation_number'], 'string','max'=>13,'length'=>13]
            ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ลำดับ',
            'companyname' => 'ชื่อบริษัท',
            'address' => 'ที่อยู่บริษัท',
            'contact' => 'ที่ติดต่อ',
            'taxation_number' => 'เลขผู้เสียภาษีอากร',
            'logo' => 'โลโก้',
            'ceo' => 'รายชื่อผู้ลงนาม ในบิล/ใบแจ้งหนี้/ใบเสร็จ',
        ];
    }

    public function upload($model, $attribute) {
        $photo = UploadedFile::getInstance($model, $attribute);
        $path = $this->getUploadPath();
        if ($this->validate() && $photo !== null) {

            $fileName = md5($photo->baseName . time()) . '.' . $photo->extension;
            //$fileName = $photo->baseName . '.' . $photo->extension;
            if ($photo->saveAs($path . $fileName)) {
                return $fileName;
            }
        }
        return $model->isNewRecord ? false : $model->getOldAttribute($attribute);
    }

    public function getUploadPath() {
        return Yii::getAlias('@webroot') . '/web/' . $this->upload_foler . '/';
    }

    public function getUploadUrl() {
        return Yii::getAlias('@web') . '/web/' . $this->upload_foler . '/';
    }

    public function getPhotoViewer() {
        return empty($this->logo) ? Yii::getAlias('@web') . '/web/img/none.png' : $this->getUploadUrl() . $this->logo;
    }

// ...
}
