<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "outgoings".
 *
 * @property integer $id
 * @property string $order_id
 * @property string $detail
 * @property integer $price
 * @property string $create_date
 */
class Outgoings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'outgoings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price'], 'integer'],
            [['create_date'], 'safe'],
            [['order_id'], 'string', 'max' => 10],
            [['detail'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'detail' => 'Detail',
            'price' => 'Price',
            'create_date' => 'Create Date',
        ];
    }
}
