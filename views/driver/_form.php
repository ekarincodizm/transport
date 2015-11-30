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
                'formConfig' => ['labelSpan' => 2, 'deviceSize' => ActiveForm::SIZE_SMALL]
    ]);
    ?>

    <?= $form->field($model, 'driver_id')->textInput(['maxlength' => true, 'value' => $driver_id, 'readonly' => 'readonly']) ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'card_id')->textInput(['maxlength' => 13]) ?>
    
     <?php
            echo $form->field($model, 'birth')->widget(\kartik\widgets\DatePicker::classname(), [
                'language' => 'th',
                'removeButton' => false,
                'options' => [
                    //'value' => date("Y-m-d"),
                    'readonly' => true,
                //'disabled' => 'disabled',
                ],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                ]
            ]);
            ?>
    
    <?= $form->field($model, 'address')->textarea(['rows' => 5]) ?>

    <?= $form->field($model, 'tel1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tel2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'driver_license_id')->textInput(['maxlength' => true]) ?>
    
    <?php
            echo $form->field($model, 'driver_license_expire')->widget(\kartik\widgets\DatePicker::classname(), [
                'language' => 'th',
                'removeButton' => false,
                'options' => [
                    //'value' => date("Y-m-d"),
                    'readonly' => true,
                //'disabled' => 'disabled',
                ],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                ]
            ]);
            ?>

    <hr/>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-save"></i> บันทึกข้อมูล' : '<i class="fa fa-edit"></i> แก้ไข', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <?= Html::resetButton('<i class="fa fa-remove"></i> ยกเลิก', ['class' => 'btn btn-danger']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
