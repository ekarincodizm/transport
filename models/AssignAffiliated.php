<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "assign".
 *
 * @property integer $id
 * @property string $order_id
 * @property string $assign_id
 * @property string $transport_date
 * @property string $cus_start
 * @property string $cus_end
 * @property integer $changwat_start
 * @property integer $changwat_end
 * @property integer $product_type
 * @property integer $weigh
 * @property integer $oil_set
 * @property integer $type_calculus
 * @property string $unit_price
 * @property string $per_times
 * @property string $income
 * @property string $allowance_driver1
 * @property string $allowance_driver2
 * @property string $create_date
 */
class AssignAffiliated extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'assign_affiliated';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['transport_date', 'create_date'], 'safe'],
            [['changwat_start', 'changwat_end', 'product_type', 'weigh', 'oil_set', 'type_calculus'], 'integer'],
            [['unit_price', 'per_times', 'income'], 'number'],
            [['order_id'], 'string', 'max' => 10],
            [['assign_id'], 'string', 'max' => 5],
            [['cus_start', 'cus_end'], 'string', 'max' => 7],
            [['allowance_driver1', 'allowance_driver2'], 'string', 'max' => 15]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'assign_id' => 'Assign ID',
            'transport_date' => 'Transport Date',
            'cus_start' => 'Cus Start',
            'cus_end' => 'Cus End',
            'changwat_start' => 'Changwat Start',
            'changwat_end' => 'Changwat End',
            'product_type' => 'Product Type',
            'weigh' => 'Weigh',
            'oil_set' => 'Oil Set',
            'type_calculus' => 'Type Calculus',
            'unit_price' => 'Unit Price',
            'per_times' => 'Per Times',
            'income' => 'Income',
            'allowance_driver1' => 'Allowance Driver1',
            'allowance_driver2' => 'Allowance Driver2',
            'create_date' => 'Create Date',
        ];
    }

}
