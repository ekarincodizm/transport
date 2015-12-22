<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "saving_type".
 *
 * @property integer $id
 * @property string $saving_type
 */
class SavingType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'saving_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['saving_type'], 'string', 'max' => 100],
            [['saving_type'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'saving_type' => 'ประเภทบัญชี',
        ];
    }
}
