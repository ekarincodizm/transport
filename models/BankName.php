<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bank_name".
 *
 * @property integer $id
 * @property string $bank_name
 */
class BankName extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bank_name';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bank_name'], 'string', 'max' => 150],
            [['bank_name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bank_name' => 'ชื่อธนาคาร',
        ];
    }
}
