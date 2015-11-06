<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\form\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Driver */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="driver-form">
    <?php
    $form = ActiveForm::begin([
                //'id' => 'login-form-horizontal',
                'type' => ActiveForm::TYPE_HORIZONTAL,
                'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
    ]);
    ?>

    <?= $form->field($model, 'driver_id')->textInput(['maxlength' => true, 'value' => $driver_id, 'readonly' => 'readonly']) ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'card_id')->textInput(['maxlength' => 13]) ?>
    <div class="form-group field-driver-driver_license_id required">
        <label class="control-label col-sm-3" for="driver-driver_license_expire">วันเกิด</label>
        <div class='col-sm-9'>
            <?php
            echo DatePicker::widget([
                'model' => $model,
                'attribute' => 'birth',
                'language' => 'th',
                'value' => date("Y-m-d"),
                'removeButton' => false,
                'readonly' => true,
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]);
            ?>
        </div>
        <div class='col-sm-offset-3 col-sm-9'></div>
        <div class='col-sm-offset-3 col-sm-9'><div class="help-block"></div></div>
    </div>
    <?= $form->field($model, 'address')->textarea(['rows' => 5]) ?>

    <?= $form->field($model, 'tel1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tel2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'driver_license_id')->textInput(['maxlength' => true]) ?>

    <?php //= $form->field($model, 'driver_license_expire')->textInput() ?>
    <div class="form-group field-driver-driver_license_id required">
        <label class="control-label col-sm-3" for="driver-driver_license_expire">วันที่หมดอายุ</label>
        <div class='col-sm-9'>
            <?php
            echo DatePicker::widget([
                'model' => $model,
                'attribute' => 'driver_license_expire',
                'language' => 'th',
                'value' => date("Y-m-d"),
                'removeButton' => false,
                'readonly' => true,
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]);
            ?>
        </div>
        <div class='col-sm-offset-3 col-sm-9'></div>
        <div class='col-sm-offset-3 col-sm-9'><div class="help-block"></div></div>
    </div>

    <hr/>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-save"></i> บันทึกข้อมูล' : '<i class="fa fa-edit"></i> แก้ไข', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <?= Html::resetButton('<i class="fa fa-remove"></i> ยกเลิก', ['class' => 'btn btn-danger']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
