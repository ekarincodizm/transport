<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "typecar".
 *
 * @property integer $id
 * @property integer $type_id
 * @property string $type_name
 */
class Typecar extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'typecar';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['type_name'], 'required'],
            [['type_name'], 'string', 'max' => 255],
            [['detail'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'รหัส',
            'type_name' => 'ประเภทรถ',
            'detail' => 'รายละเอียด'
        ];
    }

}
