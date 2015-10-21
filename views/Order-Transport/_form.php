<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\OrdersTransport */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-transport-form">
    <?php
    $form = ActiveForm::begin([
                'type' => ActiveForm::TYPE_HORIZONTAL,
                'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
    ]);
    ?>

    <?= $form->field($model, 'order_id')->textInput(['maxlength' => true, 'value' => $order_id, 'readonly' => 'leadonly']) ?>



    <?php
    echo DatePicker::widget([
        'model' => $model,
        'form' => $form,
        'attribute' => 'order_date_start',
        'language' => 'th',
        'value' => date("Y-m-d"),
        'removeButton' => false,
        'readonly' => true,
        //'required' => true,
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]);
    ?>

    <?php
    echo DatePicker::widget([
        'model' => $model,
        'form' => $form,
        'attribute' => 'order_date_end',
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

    <?php
    echo $form->field($model, 'truck1')->dropDownList(ArrayHelper::map(\app\models\Truck::find()->all(), 'id', 'license_plate'), [
        'id' => 'id',
        'required' => 'required',
        'prompt' => 'เลือกรถบรรทุก',
            /*
              'pluginOptions' => [
              'allowClear' => true
              ],
             * 
             */
    ]);
    ?>

    <?php
    echo $form->field($model, 'truck2')->dropDownList(ArrayHelper::map(\app\models\Truck::find()->all(), 'id', 'license_plate'), [
        'id' => 'id',
        //'required' => 'required',
        'prompt' => 'เลือกรถถบรรทุก',
            /*
              'pluginOptions' => [
              'allowClear' => true
              ],
             * 
             */
    ]);
    ?>

    <?php
    $sql1 = "select id,concat(name,' ',lname) as name from driver";
    echo $form->field($model, 'driver1')->dropDownList(ArrayHelper::map(\app\models\Driver::findBySql($sql1)->all(), 'id', 'name'), [
        'id' => 'id',
        'required' => 'required',
        'prompt' => 'เลือกคนขับ',
            /*
              'pluginOptions' => [
              'allowClear' => true
              ],
             * 
             */
    ]);
    ?>

    <?php
    echo $form->field($model, 'driver2')->dropDownList(ArrayHelper::map(\app\models\Driver::findBySql($sql1)->all(), 'id', 'name'), [
        'id' => 'id',
        //'required' => 'required',
        'prompt' => 'เลือกคนขับ',
            /*
              'pluginOptions' => [
              'allowClear' => true
              ],
             * 
             */
    ]);
    ?>

    <?= $form->field($model, 'create_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
