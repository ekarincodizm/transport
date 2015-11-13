<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Repair */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="repair-form">

    <?php
    $form = ActiveForm::begin([
                //'id' => 'login-form-horizontal',
                'type' => ActiveForm::TYPE_HORIZONTAL,
                'formConfig' => ['labelSpan' => 2, 'deviceSize' => ActiveForm::SIZE_SMALL]
    ]);
    ?>

    <?= $form->field($model, 'truck_license')->textInput(['maxlength' => true, 'value' => $truck_license, 'readonly' => 'readly']) ?>

    <?= $form->field($model, 'detail')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->textInput() ?>
   
            <?php
            /*
              echo DatePicker::widget([
              'model' => $model,
              'id' => 'create_date',
              'name' => 'create_date',
              'attribute' => 'create_date',
              //'type' => DatePicker::TYPE_INPUT,
              'language' => 'th',
              'value' => '2015-11-15',
              'removeButton' => false,
              'readonly' => true,
              'pluginOptions' => [
              'autoclose' => true,
              'format' => 'yyyy-mm-dd',
              'todayHighlight' => true,
              ]
              ]);
             * 
             */
            ?>

            <?php
            echo $form->field($model, 'create_date')->widget(\kartik\widgets\DatePicker::classname(), [
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

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <?= Html::submitButton($model->isNewRecord ? 'บันทึก' : 'แก้ไข', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

