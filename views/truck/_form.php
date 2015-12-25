<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

//use kartik\widgets\DepDrop;

/* @var $this yii\web\View */
/* @var $model app\models\Truck */
/* @var $form yii\widgets\ActiveForm */

if ($flag == '1') {
    $readonly = true;
} else {
    $readonly = false;
}
?>

<div class="truck-form">

    <?php
    $form = ActiveForm::begin([
                //'id' => 'login-form-horizontal',
                'type' => ActiveForm::TYPE_HORIZONTAL,
                'formConfig' => ['labelSpan' => 2, 'deviceSize' => ActiveForm::SIZE_SMALL]
    ]);
    ?>
    <?php
    echo $form->field($model, 'type_id')->dropDownList(ArrayHelper::map(\app\models\Typecar::find()->all(), 'id', 'type_name'), [
        'id' => 'id',
        'required' => 'required',
        'prompt' => 'เลือกประเภทรถ',
            /*
              'pluginOptions' => [
              'allowClear' => true
              ],
             * 
             */
    ]);
    ?>
    <?= $form->field($model, 'license_plate')->textInput(['maxlength' => true, 'readonly' => $readonly]) ?>

    <?= $form->field($model, 'brand')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'color')->textInput(['maxlength' => true]) ?>

            <?php
            /*
              echo DatePicker::widget([
              'model' => $model,
              'attribute' => 'date_buy',
              'language' => 'th',
              'value' => date("Y-m-d"),
              'removeButton' => false,
              'readonly' => true,
              'pluginOptions' => [
              'autoclose' => true,
              'format' => 'yyyy-mm-dd'
              ]
              ]);
             * 
             */
            ?>

            <?php
            echo $form->field($model, 'date_buy')->widget(\kartik\widgets\DatePicker::classname(), [
                'language' => 'th',
                'removeButton' => false,
                'options' => [
                    'value' => date("Y-m-d"),
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

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'down')->textInput() ?>

    <?= $form->field($model, 'period_price')->textInput() ?>

    <?= $form->field($model, 'period')->textInput(['placeholder' => 'กรอกตัวเลขจำนวนเต็ม เช่น(1,2,3,...99)']) ?>

    <?= $form->field($model, 'date_supply')->textInput(['placeholder' => 'กรอกตัวเลข 2 หลัก เช่น(01)']) ?>

    <?php // $form->field($model, 'type_id')->textInput()    ?>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-save"></i> บันทึกข้อมูล' : '<i class="fa fa-pencil"></i> แก้ไข', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <?= Html::resetButton('<i class="fa fa-remove"></i> ยกเลิก', ['class' => 'btn btn-danger']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
