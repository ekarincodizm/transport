<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "changwat".
 *
 * @property integer $changwat_id
 * @property string $changwat_code
 * @property string $changwat_name
 * @property integer $geo_id
 */
class Changwat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'changwat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['changwat_code', 'changwat_name'], 'required'],
            [['geo_id'], 'integer'],
            [['changwat_code'], 'string', 'max' => 2],
            [['changwat_name'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'changwat_id' => 'Changwat ID',
            'changwat_code' => 'Changwat Code',
            'changwat_name' => 'Changwat Name',
            'geo_id' => 'Geo ID',
        ];
    }
}
