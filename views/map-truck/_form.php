<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\MapTruck */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="map-truck-form">

    <?php
    $form = ActiveForm::begin([
                'type' => ActiveForm::TYPE_HORIZONTAL,
                'formConfig' => ['labelSpan' => 2, 'deviceSize' => ActiveForm::SIZE_SMALL]
    ]);
    ?>
    
    <?php
    echo $form->field($model, 'truck_1')->dropDownList(ArrayHelper::map(\app\models\Truck::find()->where(['type_id' => '1'])->all(), 'license_plate', 'license_plate'), [
        'id' => 'id',
        'required' => 'required',
        'prompt' => 'เลือกหัวลาก',
            /*
              'pluginOptions' => [
              'allowClear' => true
              ],
             * 
             */
    ]);
    ?>
    
    <?php
    echo $form->field($model, 'truck_2')->dropDownList(ArrayHelper::map(\app\models\Truck::find()->where(['type_id' => '2'])->all(), 'license_plate', 'license_plate'), [
        'id' => 'id',
        'required' => 'required',
        'prompt' => 'เลือกพ่วง',
            /*
              'pluginOptions' => [
              'allowClear' => true
              ],
             * 
             */
    ]);
    ?>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-save"></i> บันทึกข้อมูล' : '<i class="fa fa-pencil"></i> แก้ไข', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <?= Html::resetButton('<i class="fa fa-remove"></i> ยกเลิก', ['class' => 'btn btn-danger']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
