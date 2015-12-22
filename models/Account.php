<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "account".
 *
 * @property integer $id
 * @property string $account_number
 * @property string $account_name
 * @property string $saving_type
 * @property string $bank_name
 * @property string $brance
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
            [['account_number', 'account_name', 'saving_type', 'bank_name', 'brance', 'status'], 'required'],
            [['status'], 'integer'],
            [['account_number'], 'string', 'max' => 10],
            [['account_name', 'saving_type'], 'string', 'max' => 100],
            [['bank_name', 'brance'], 'string', 'max' => 150],
            [['account_number'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'account_number' => 'เลขที่บัญชี',
            'account_name' => 'ชื่อเจ้าของบัญชี',
            'saving_type' => 'ประเภทบัญชี',
            'bank_name' => 'ธนาคาร',
            'brance' => 'สาขาธนาคาร',
            'status' => 'สถานะ',
        ];
    }
}
