<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "account".
 *
 * @property integer $id
 * @property string $account_number
 * @property string $account_name
 * @property integer $saving_type
 * @property integer $bank_name
 * @property integer $status
 */
class Account extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'account_number'], 'required'],
            [['id', 'saving_type', 'bank_name', 'status'], 'integer'],
            [['account_number'], 'string', 'max' => 10],
            [['account_name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'account_number' => 'เลขที่บัญชี',
            'account_name' => 'ชื่อเจ้าของบัญชี',
            'saving_type' => 'ประเภทบัญชี',
            'bank_name' => 'ธนาคาร',
            'status' => 'สถานะของบัญชี',
        ];
    }
}
