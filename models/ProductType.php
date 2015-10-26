<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_type".
 *
 * @property integer $id
 * @property string $product_type
 */
class ProductType extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'product_type';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['product_type'], 'required'],
            [['product_type'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'product_type' => 'ประเภทสินค้า',
        ];
    }

}
